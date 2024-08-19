def connect_db():
    
    # Connect to the database
    connection = mysql.connector.connect(
        host="db-natuna.ctmogcuxclxn.ap-southeast-1.rds.amazonaws.com",
        user="admin",
        passwd="cujwiq-suqhu2-bycpuB",
        database="web-app"
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

def load_raw(filepath):
    # Open the .mdl file in read mode
    with open(filepath, 'r', encoding='utf-8') as file:
        # Read the content of the file
        mdl_content = file.read()
    return mdl_content

def change_final_time(model):
    temp = model.split('FINAL TIME  = ')
    
    result = []
    
    # Split into 3 parts, 1: Before final time, 2: Final time, 3: After final time
    file_awal = temp[0] + 'FINAL TIME  = '
    final_time = final_step
    file_akhir = '\n'+temp[1].split('\n', 1)[-1]

    result.append(file_awal)
    result.append(final_time)
    result.append(file_akhir)
    
    model = ''.join(map(str, result))
    return model

def change_variable_value(model):
    variables = model.split('********************************************************')[0]
    control_variables = '********************************************************' + '********************************************************'.join(model.split('********************************************************')[1:])

    variables = variables.replace('{UTF-8}', '').split('|')
    
    json_variables = []
    for row in variables[:-1]:
        row
        # break
        temp = row.split('=')
        variable_name = temp[0]
        variable_value = temp[1].split('~')
        temp = []
        for row in variable_value:
            temp.append(row.replace('\t','').replace('\n', ''))
        variable_value = temp
        res = {
            'variable_name': variable_name.replace('\n', ''),
            'variable_value': variable_value[0],
            'variable_level': 'NULL' if variable_value[1] == '' else variable_value[1],
            'variable_unit': 'NULL' if variable_value[2] == '' else variable_value[2]
        }
        json_variables.append(res)
        
    conn = connect_db()
    query = f'SELECT variables.name, scenario_variables.value, scenario_variables.level, scenario_variables.unit FROM scenario_variables join variables on scenario_variables.variable_id = variables.id WHERE scenario_id = {scenario_id}'
    records = read_query(query, conn)
    conn.close()
    
    data_from_model = pd.DataFrame(json_variables)    
    data_master_from_db = pd.DataFrame(records, columns=['variable_name', 'variable_value', 'variable_level', 'variable_unit'])
    
    # update data_from_model with data_master_from_db if the variable_name is exist on 2 tables
    for index, row in data_from_model.iterrows():
        if row['variable_name'] in data_master_from_db['variable_name'].values:
            data_from_model.loc[index] = data_master_from_db.loc[data_master_from_db['variable_name'] == row['variable_name']].values[0]
    
    result_variables = []
    for idx, row in data_from_model.iterrows():
        text = ''
        variable_name = '\n\n' + row['variable_name'] + '=\n'
        variable_value = '\t' + (row['variable_value'] + '\n' if row['variable_value'] != 'NULL' else '\n') + '\t~'
        variable_value = variable_value.replace('\\', '\\\n')
        variable_level = '\t' + (row['variable_level'] + '\n' if row['variable_level'] != 'NULL' else '\n') + '\t~'
        variable_unit = '\t' + (row['variable_unit'] + '\n' if row['variable_unit'] != 'NULL' else '') + '\t|'
        
        text = variable_name + variable_value + variable_level + variable_unit
        result_variables.append(text)
        
    result_variables = ''.join(map(str, result_variables))
    result_variables = result_variables + '\n\n'
    result_variables = '{UTF-8}' + result_variables[1:]
        
    final_model = result_variables + control_variables
    return final_model

def export_model(model, filepath):
    # export the final model to .mdl file
    try:
        with open(filepath, 'w', encoding='utf-8') as file:
            file.write(model)
            file.close()
            return True
    except Exception as e:
        return str(e)


if __name__ == '__main__':
    import pandas as pd
    import mysql.connector 
    import argparse
    
    argparse = argparse.ArgumentParser()
    argparse.add_argument('--filepath', '-f', type=str, required=True)
    argparse.add_argument('--export_filepath', '-e', type=str, required=True)
    argparse.add_argument('--final_time', '-t', type=int, required=True)
    argparse.add_argument('--scenario_id', '-s', type=int, required=True)
    
    # filepath = '../../storage/app/uploads/Q029J5Z56q6tKbGmsm62wH0RGZCmrOSTlAilcQqx.bin'
    # export_filepath = 'export-model-final.mdl'
    # final_step = 140
    # scenario_id = 10
    filepath = argparse.parse_args().filepath
    export_filepath = argparse.parse_args().export_filepath
    final_step = argparse.parse_args().final_time
    scenario_id = argparse.parse_args().scenario_id
    
    print('Filepath:', filepath)
    print('Export Filepath:', export_filepath)
    print('Final Time:', final_step)
    print('Scenario ID:', scenario_id)
    

    print('Start exporting model...')
    model = load_raw(filepath)
    print('Model has been loaded')
    print('Changing final time...')
    model = change_final_time(model)
    print('Final time has been changed to', final_step)
    print('Changing variable values...')
    model = change_variable_value(model)
    print('Variable values has been changed')
    
    # export the model
    result = export_model(model, export_filepath)
    if result != True:
        print(result)
    print('Model has been exported to', export_filepath)
    
    # update the modelpath in the database
    conn = connect_db()
    query = f"UPDATE scenarios SET export_path = '{export_filepath}' WHERE id = {scenario_id}"
    result = execute_query(query, conn)
    
    if result != True:
        print(result)
    
    
    
    