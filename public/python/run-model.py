def read_model(path):
    # Open the .mdl file in read mode
    with open(path, 'r', encoding='utf-8') as file:
        # Read the content of the file
        mdl_content = file.read()
        
    # Split the content of the file by the newline character
    content_splitter = '********************************************************'

    mdl_content = mdl_content.split(content_splitter)[0].replace('{UTF-8}', '\n').replace('\n','').replace('\t', '')
    variables = mdl_content.split('|')
    
    result = []
    for item in variables[:-1]:
        result.append(item.split('\t'))
    result
    
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
        
    final_data = pd.read_json(json.dumps(final))
    final_data
    print(final_data)
    
def conn():
    connection = mysql.connector.connect(
    host="db-natuna.ctmogcuxclxn.ap-southeast-1.rds.amazonaws.com",
    user="admin",
    passwd="cujwiq-suqhu2-bycpuB",
    database="web-app"
    )
    
    return connection

def check_connection():
    connection = conn()
    if connection.is_connected():
        print("Connected to MySQL")
        result = True
    else:
        print("Connection failed")
        result = False
    connection.close()
    return result
    
def insert_query(query):
    connection = conn()
    cursor = connection.cursor()
    cursor.execute(query)
    connection.commit()
    cursor.close()
    connection.close()

def read_query(query):
    connection = conn()
    cursor = connection.cursor()
    cursor.execute(query)
    result = cursor.fetchall()
    cursor.close()
    connection.close()
    
    return result
    
    
if __name__ == '__main__':
    # Read the model from the .mdl file
    import pandas as pd
    import json
    import argparse
    import mysql.connector
    
    parser = argparse.ArgumentParser(description='Read the model from the .mdl file')
    parser.add_argument('--path', type=str, help='Path of the .mdl file')
    parser.add_argument('--name', type=str, help='Name of the model')
    parser.add_argument('--desc', type=str, help='Description of the model')
    args = parser.parse_args()
    
    read_model(args.path)
    
    
    if check_connection():
        # insert model name
        query = "INSERT INTO models (name, description) VALUES ('{}', '{}')".format(args.name, args.desc)
        
        try:
            insert_query(query)
            print('Model inserted successfully')
        except Exception as e:
            print('Error inserting model')
            print(str(e))
        
        
        # insert variables    