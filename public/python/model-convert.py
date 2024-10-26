def connect_db():
    
    # Connect to the database
    connection = mysql.connector.connect(
        host="db-natuna.ctmogcuxclxn.ap-southeast-1.rds.amazonaws.com",
        user="admin",
        passwd="cujwiq-suqhu2-bycpuB",
        database="web-app-dev"
    )
    return connection

def check_connection(conn):
    if conn.is_connected():
        return True
    else:
        return False

def execute_query(query, conn):
    result = None
    try:
        cursor = conn.cursor()
        cursor.execute(query)
        conn.commit()
        result = True
    except Exception as e:
        result = 'ERROR: ' + str(e)
        
    conn.commit()
    return result
    
def read_query(query, conn):
    cursor = conn.cursor()
    cursor.execute(query)
    result = cursor.fetchall()
    return result

def load_model(file_name, model_id):
    # Open the .mdl file in read mode
    with open(file_name, 'r', encoding='utf-8') as file:
        # Read the content of the file
        mdl_content = file.read()
    # Split the content of the file by the newline character


    mdl_content = mdl_content.split('********************************************************')[0].replace('{UTF-8}', '\n').replace('\n','').replace('\t', '')
    variables = mdl_content.split('|')
    
    result = []
    for item in variables[:-1]:
        result.append(item.split('\t'))
        
    
    final = []
    for item in result:
        item = item[0]
        temp = {}
        try:
            # print(item)
            temp_list = item.split('~')        
            # print(temp_list)
            
            # temp_list = temp_list[1].split('~')
            temp['name'] = temp_list[0].split('=')[0]
            # print(len(temp_list[0].split('=')[0]))
            temp['value'] = '='.join(temp_list[0].split('=')[1:]).strip()
            temp['level'] = temp_list[-2]
            temp['unit'] = temp_list[-1]
            
            # temp_list = temp_list[0].split('=')[0]
            
        except Exception as e:
            print('error')
            print(str(e))
            print(item)
            break
        final.append(temp)
    
    df = pd.read_json(json.dumps(final))
    df = df.fillna('NULL')
    df = df.replace('', 'NULL')
    df['model_id'] = model_id
    
    return df
        

def insert_variables(df):
    values = []
    model = df
    
    conn = connect_db()
    for idx, row in model.iterrows():
        values.append(f"('{row['name']}', '{row['value']}', '{row['level']}', '{row['unit']}', {row['model_id']})")

    # Create the full query with all accumulated values
    query = "INSERT INTO variables (name, value, level, unit, model_id) VALUES " + ", ".join(values)

    # Execute the query
    res = execute_query(query, conn)
    if res != True:
        print(res)

    conn.close()
    
    
def load_raw(file_name):
    # Open the .mdl file in read mode
    with open(file_name, 'r', encoding='utf-8') as file:
        # Read the content of the file
        mdl_content = file.read()
    return mdl_content


def get_sfd_name(file_name):
    model = load_raw(file_name).split('********************************************************')[-1].split('*')
    
    # last model modify to split "///---\\\"
    temp =  model[-1].split('///---\\\n')[0]
    
    #change the last model to temp
    model[-1] = temp
    number_of_sfd = 0
    sfds = []

    for m in model:
        temp1 = m.split('\n')[0].strip()
        if temp1 != '~':
            number_of_sfd += 1
            sfd_name = temp1
            sfds.append(sfd_name)
    return sfds


def get_sfd_id(model_id):
    conn = connect_db()
    try:
        query = f"SELECT id, name FROM sfd WHERE model_id = {model_id}"
        result = read_query(query, conn)
    except Exception as e:
        print(str(e))
    finally:
        conn.close()
        return result
    
def get_variable_id(model_id):
    conn = connect_db()
    try:
        query = f"SELECT id, name FROM variables WHERE model_id = '{model_id}'"
        result = read_query(query, conn)
    except Exception as e:
        print(str(e))
    finally:
        conn.close()
        return result


def insert_sfd_name(sfds, model_id):
    print(sfds)
    conn = connect_db()
    try:
        values = []
        for sfd in sfds:
            values.append(f"('{sfd}', {model_id})")
        
        query = "INSERT INTO sfd (name, model_id) VALUES " + ", ".join(values)
        res = execute_query(query, conn)
        if res != True:
            print(res)
    except Exception as e:
        print(str(e))
    finally:
        conn.close()


def get_sfd(file_name, model_id):
    try:
        model = load_raw(file_name).split('********************************************************')[-1].split('*')

        temp = model[-1].split('///---\\\n')[0]
        model[-1] = temp
        
        number_of_sfd = 0
        all_sfd_variables = []

        # Load data from the database
        sfd_ids = dict(get_sfd_id(model_id))
        variable_ids = dict(get_variable_id(model_id))
        print(variable_ids)
        
        df_sfd = pd.DataFrame(sfd_ids.items(), columns=['id', 'name'])
        df_variable = pd.DataFrame(variable_ids.items(), columns=['id', 'name'])  

        for m in model:
            number_of_sfd += 1
            sfd_name = m.split('\n')[0].strip()
            sfd_variables = []
            variables = m.split('\n')

            for variable in variables:
                # Handle exceptions and extract valid variable names
                try:
                    if variable.startswith('10'):
                        variable_name = variable.split(',')[2].strip()
                        if variable_name and variable_name[0].isalpha():  # Check if valid string
                            sfd_variables.append(variable_name)
                except IndexError:
                    continue  # Skip if index issues arise

            # Add extracted variables to the list
            for variable in sfd_variables:
                all_sfd_variables.append({
                    'sfd_name': sfd_name,
                    'variable': variable.strip(),
                    'model_id': model_id,
                })

        # Create dataframe for the final result
        df = pd.DataFrame(all_sfd_variables)

        # Perform merging outside of the loop for efficiency
        if not df.empty:
            df = df.merge(df_sfd, left_on='sfd_name', right_on='name', how='inner')
            df = df.merge(df_variable, left_on='variable', right_on='name', how='inner')
            df = df[['id_x', 'id_y', 'model_id']]
            df.columns = ['sfd_id', 'variable_id', 'model_id']
        
        return df
    except Exception as e:
        print(f"An error occurred: {e}")
        # show the error
        
        return pd.DataFrame()  # Return an empty dataframe on error

    
def insert_sfd_variables(df):
    conn = connect_db()
    try:
        values = []
        for idx, row in df.iterrows():
            values.append(f"({row['sfd_id']}, {row['variable_id']})")
        
        query = "INSERT INTO sfd_variable (sfd_id, variable_id) VALUES " + ", ".join(values)
        
        try:
            res = execute_query(query, conn)
            if res != True:
                print(res)
        except Exception as e:
            print(str(e))
            print('Error')
            print('ERROR DETAIL : ', res)
            print('ERROR QUERY : ', query)
    except Exception as e:
        print(str(e))
    finally:
        conn.close()

if __name__ == '__main__':
    import json
    import pandas as pd
    import mysql.connector
    import os
    import argparse
    import warnings
    warnings.filterwarnings('ignore')
    import logging
    import uuid
    
    LOG_ID = str(uuid.uuid4())
    # setup logging
    logging.basicConfig(level=logging.INFO)
    
    logger = logging.getLogger(f"LOG_ID: {LOG_ID} | Model Convert")
    

    parser = argparse.ArgumentParser(description='Convert Model File to Database')

    # Define optional arguments with flags
    parser.add_argument('-f', '--file_name', required=True, help='Model File Name')
    parser.add_argument('-m', '--model_id', required=True, help='Model ID')

    args = parser.parse_args()

    file_name = args.file_name
    model_id = args.model_id
    
    # FLOW:
    # 1. Load the model file (variables)
    # 2. Parse the model file
    # 3. Store the model file in the database
    # 4. Load the SFD Model
    # 5. Store the SFD Model in the database
    # 6. Load the SFD Variables
    # 7. get the ID of the SFD Model
    # 8. Store the SFD Variabl`es in the database
    
    model = load_model(file_name, model_id)
    insert_variables(model)
    print('Model Variables Loaded')
    
    # Register SFD  
    logger.info('LOG_ID: {LOG_ID} | Loading SFD Name')
    sfds = get_sfd_name(file_name)
    insert_sfd_name(sfds, model_id)
    logger.info(f"LOG_ID: {LOG_ID} | SFD Name Loaded : {sfds}")
    logger.info('LOG_ID: {LOG_ID} | SFD Name Loaded')
    
    # Load SFD Variables
    logger.info('LOG_ID: {LOG_ID} | Loading SFD VARIABLES')
    sfd_variables = get_sfd(file_name, model_id)
    logger.info(f"LOG_ID: {LOG_ID} | SFD Variables Loaded : {sfd_variables}")
    logger.info(f"LOG_ID: {LOG_ID} | SFD Variables Loaded : {sfd_variables.shape}")
    
    logger.info('LOG_ID: {LOG_ID} | Inserting SFD')
    insert_sfd_variables(sfd_variables)
    logger.info('LOG_ID: {LOG_ID} | SFD Variables Loaded')
    
    logger.info('LOG_ID: {LOG_ID} | Model Convert Completed')
    
    
    
