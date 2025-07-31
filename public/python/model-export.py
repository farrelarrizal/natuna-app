import pandas as pd
import mysql.connector
import argparse
import os


def connect_db():
    connection = mysql.connector.connect(
        host="103.250.11.186",
        user="its-user",
        passwd="kudalumping13",
        database="dasina"
    )
    return connection

def check_connection(conn):
    return conn.is_connected()

def execute_query(query, conn):
    try:
        cursor = conn.cursor()
        cursor.execute(query)
        conn.commit()
        return True
    except Exception as e:
        return 'ERROR: ' + str(e)

def read_query(query, conn):
    cursor = conn.cursor()
    cursor.execute(query)
    return cursor.fetchall()

def load_raw(filepath):
    with open(filepath, 'r', encoding='utf-8') as file:
        return file.read()

def change_final_time(model, final_step):
    parts = model.split('FINAL TIME  = ')
    if len(parts) < 2:
        raise ValueError('FINAL TIME not found in model')

    before = parts[0] + 'FINAL TIME  = '
    after = '\n' + parts[1].split('\n', 1)[-1]
    return before + str(final_step) + after

def change_variable_value(model, scenario_id):
    variables = model.split('********************************************************')[0]
    control_variables = '********************************************************' + '********************************************************'.join(model.split('********************************************************')[1:])

    variables = variables.replace('{UTF-8}', '').split('|')
    
    json_variables = []
    for row in variables[:-1]:
        temp = row.split('=')
        if len(temp) < 2:
            continue  # Skip malformed lines
        variable_name = temp[0].strip()
        variable_values = temp[1].split('~')
        cleaned_values = [val.strip().replace('\t','').replace('\n', '') for val in variable_values]
        while len(cleaned_values) < 3:
            cleaned_values.append('')
        json_variables.append({
            'variable_name': variable_name,
            'variable_value': cleaned_values[0],
            'variable_level': 'NULL' if cleaned_values[1] == '' else cleaned_values[1],
            'variable_unit': 'NULL' if cleaned_values[2] == '' else cleaned_values[2]
        })

    conn = connect_db()
    query = f"""
        SELECT variables.name, scenario_variables.value, scenario_variables.level, scenario_variables.unit 
        FROM scenario_variables 
        JOIN variables ON scenario_variables.variable_id = variables.id 
        WHERE scenario_id = {scenario_id}
    """
    records = read_query(query, conn)
    conn.close()

    data_from_model = pd.DataFrame(json_variables)    
    data_master_from_db = pd.DataFrame(records, columns=['variable_name', 'variable_value', 'variable_level', 'variable_unit'])

    for index, row in data_from_model.iterrows():
        if row['variable_name'] in data_master_from_db['variable_name'].values:
            matched = data_master_from_db[data_master_from_db['variable_name'] == row['variable_name']].iloc[0]
            data_from_model.loc[index] = matched

    result_variables = []
    for _, row in data_from_model.iterrows():
        text = (
            f"\n\n{row['variable_name']}=\n"
            f"\t{row['variable_value'] if row['variable_value'] != 'NULL' else ''}\n\t~"
            f"\t{row['variable_level'] if row['variable_level'] != 'NULL' else ''}\n\t~"
            f"\t{row['variable_unit'] if row['variable_unit'] != 'NULL' else ''}\t|"
        )
        result_variables.append(text)

    result_variables = '{UTF-8}' + ''.join(result_variables)[1:] + '\n\n'
    return result_variables + control_variables


def export_model(model, filepath):
    try:
        # Create parent directories if they don't exist
        os.makedirs(os.path.dirname(filepath), exist_ok=True)

        # Now safe to write (creates or overwrites file)
        with open(filepath, 'w', encoding='utf-8') as file:
            file.write(model)
        return True
    except Exception as e:
        print('Export Error:', e)
        return str(e)


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument('--filepath', '-f', type=str, required=True)
    parser.add_argument('--export_filepath', '-e', type=str, required=True)
    parser.add_argument('--final_time', '-t', type=int, required=True)
    parser.add_argument('--scenario_id', '-s', type=int, required=True)
    args = parser.parse_args()


    print('Start exporting model...')
    print('Loading model from', args.filepath)
    model = load_raw(args.filepath)
    print('Model has been loaded')

    print('Changing final time...')
    model = change_final_time(model, args.final_time)
    print('Final time has been changed to', args.final_time)

    print('Changing variable values...')
    model = change_variable_value(model, args.scenario_id)
    print('Variable values have been changed')

    result = export_model(model, args.export_filepath)
    if result is not True:
        print('Export Error:', result)
    else:
        print('Model exported to', args.export_filepath)

    print('Updating export path in database...')
    conn = connect_db()
    update_query = f"UPDATE scenarios SET export_path = '{args.export_filepath}' WHERE id = {args.scenario_id}"
    result = execute_query(update_query, conn)
    conn.close()

    if result is not True:
        print('DB Update Error:', result)
    else:
        print('Export path updated in database.')

if __name__ == '__main__':
    main()
