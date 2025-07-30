def connect_db():
    
    # Connect to the database
    connection = mysql.connector.connect(
        host="103.250.11.186",
        user="its-user",
        passwd="kudalumping13",
        database="dasina"
    )
    return connection

def check_connection(conn):
    if conn.is_connected():
        return True
    else:
        return False

def execute_query(query, conn):
    try:
        with conn.cursor() as cursor:
            cursor.execute(query)
        conn.commit()
        return True
    except Exception as e:
        conn.rollback()  # Rollback changes if error occurs
        return f'ERROR: {e}'

    
def read_query(query, conn):
    cursor = conn.cursor()
    cursor.execute(query)
    result = cursor.fetchall()
    return result

def send_notif(message: str):   
    """
    Send a notification message to a specified Telegram chat via the Telegram API.
    :param token: Telegram Bot API token.
    :param chat_id: The chat ID where the message will be sent.
    :param message: The message text to be sent.
    """
    token = '7822549251:AAGZ6HVlKSjreqpeVzVQNiMWODtaBowB4ns'
    chat_id = 1363019510
    url = f"https://api.telegram.org/bot{token}/sendMessage"
    payload = {
        "chat_id": chat_id,
        "text": message
    }
    
    response = requests.post(url, json=payload)
    
    if response.status_code != 200:
        raise Exception(f"Failed to send message: {response.status_code} - {response.text}")

def load_model(file_name, model_id):
    # Open the .mdl file in read mode
    with open(file_name, 'r', encoding='utf-8') as file:
        # Read the content of the file
        mdl_content = file.read()
    
    # Process content to isolate variables and sanitize backslashes
    mdl_content = mdl_content.split('********************************************************')[0].replace('{UTF-8}', '\n').replace('\n', '').replace('\t', '')
    mdl_content = mdl_content.replace('\\', '')  # Remove unintended backslashes
    
    # Split content to separate variables
    variables = mdl_content.split('|')
    
    result = []
    for item in variables[:-1]:
        result.append(item.split('\t'))
        
    final = []
    for item in result:
        item = item[0]
        temp = {}
        try:
            temp_list = item.split('~')
            
            # Extract variable components: name, value, level, and unit
            temp['name'] = temp_list[0].split('=')[0].strip()
            temp['value'] = '='.join(temp_list[0].split('=')[1:]).strip().replace('\\', '')  # Remove unintended backslashes in values
            temp['level'] = temp_list[-2].strip() if len(temp_list) > 1 else 'NULL'
            temp['unit'] = temp_list[-1].strip() if len(temp_list) > 2 else 'NULL'
            
        except Exception as e:
            print(f"Error processing variable: {str(e)} - Item: {item}")
            break
        final.append(temp)
    
    # Convert result to a DataFrame
    df = pd.DataFrame(final)
    df = df.fillna('NULL')
    df = df.replace('', 'NULL')
    df['model_id'] = model_id
    
    return df


def insert_variables(df):
    try:
            
        values = []
        model = df
        
        conn = connect_db()
        for idx, row in model.iterrows():
            values.append(f"('{row['name']}', '{row['value']}', '{row['level']}', '{row['unit']}', {row['model_id']})")

        # Create the full query with all accumulated values
        query = "INSERT INTO variables (name, value, level, unit, model_id) VALUES " + ", ".join(values)
        # Execute the query
        res = execute_query(query, conn)
        send_notif(str(res))
        if res != True:
            print(res)

        conn.close()
        return True
    except Exception as e:
        send_notif(f"Error inserting variables: {str(e)}")
        # Optionally, you can log the error or handle it as needed
        return False
    
    
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
        

def insert_final_time(model_id, final_time):
    conn = connect_db()
    try:
        query = f"UPDATE models SET final_step = {final_time} WHERE id = {model_id}"
        res = execute_query(query, conn)
        if res != True:
            print(res)
    except Exception as e:
        print(str(e))
    finally:
        conn.close()

def run_and_insert(model_id, model_vensim):
    conn = connect_db()
    try:
        # Run the model and convert the result to a dictionary
        res = model_vensim.run().to_dict()
        
        # Get the variable IDs from the database
        variable_ids = dict(get_variable_id(model_id))
        df_variable = pd.DataFrame(variable_ids.items(), columns=['id', 'name'])
        
        # Get the scenario ID
        query = f"SELECT id FROM scenarios WHERE model_id = {model_id} AND name = 'Base Model'"
        send_notif(f"query: {query}")
        scenario_result = read_query(query, conn)
        if not scenario_result:
            send_notif("Error: Scenario not found.")
            return
        scenario_id = scenario_result[0][0]
        send_notif(f"scenario_id: {scenario_id}")
        
        # Prepare the insert values for each node point (time step) based on db variables
        values = []
        for var_name in df_variable['name'].values:
            if var_name in res:
                variable_id = df_variable[df_variable['name'] == var_name]['id'].values[0]
                
                # Iterate over node points in the result
                for node_point, value in res[var_name].items():
                    # Format float value to limit precision
                    formatted_value = f"{value:.4f}" if isinstance(value, float) else value
                    values.append(f"({variable_id}, {scenario_id}, {node_point}, {formatted_value})")
            else:
                send_notif(f"Variable '{var_name}' not found in model results.")
        
        # Send sample values to check
        send_notif(f"Sample values: {values[:2]}")
        
        # Insert the scenario data with node points, ensuring the query isn’t too long
        if values:
            max_insert_size = 1000  # Insert in batches if too long
            for i in range(0, len(values), max_insert_size):
                batch_values = values[i:i + max_insert_size]
                query = "INSERT INTO scenario_data (variable_id, scenario_id, node_point, value) VALUES " + ", ".join(batch_values)
                # send_notif(f"query (batch {i // max_insert_size + 1}): {query[:500]}...")  # Log part of the query for review
                res = execute_query(query, conn)
                if res != True:
                    print(res)
        else:
            send_notif("No data to insert.")
    except Exception as e:
        print(str(e))
        send_notif(f"Error: {str(e)}")
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
    import pysd    
    import requests

    parser = argparse.ArgumentParser(description='Convert Model File to Database')

    # Define optional arguments with flags
    parser.add_argument('-f', '--file_name', required=True, help='Model File Name')
    parser.add_argument('-m', '--model_id', required=True, help='Model ID')

    args = parser.parse_args()

    file_name = args.file_name
    model_id = args.model_id
    
    send_notif(f"Model {model_id} is being converted from file {file_name}")
    
    # FLOW:
    # 1. Load the model file (variables)
    # 2. Parse the model file
    # 3. Store the model file in the database
    # 4. Load the SFD Model
    # 5. Store the SFD Model in the database
    # 6. Load the SFD Variables
    # 7. get the ID of the SFD Model
    # 8. Store the SFD Variabl`es in the database
    
    try:
        model = load_model(file_name, model_id)
        send_notif(f"Model {model_id} is being loaded")
        if insert_variables(model) != True:
            send_notif(f"Error while inserting variables for model {model_id}")
        send_notif('Model Variables Loaded')
        
        # Register SFD  
        sfds = get_sfd_name(file_name)
        insert_sfd_name(sfds, model_id)
        
        # Load SFD Variables
        sfd_variables = get_sfd(file_name, model_id)
        
        insert_sfd_variables(sfd_variables)
    
        # get the final_time
        model_vensim = pysd.read_vensim(file_name)
        final_time = model_vensim.components.final_time()
        send_notif(f"Final time for model {model_id} is {final_time}")
        
        # insert final time
        insert_final_time(model_id, final_time)
        
        # running the model and insert the scenario data of base model
        run_and_insert(model_id, model_vensim)
        
        # send notification
        send_notif(f"Model {model_id} successfully loaded")
    except Exception as e:
        send_notif(f"Error while loading model {model_id}. ERROR: {str(e)}")
        print(f"Error while loading model {model_id}. ERROR: {str(e)}")
    
    
