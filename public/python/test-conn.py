import mysql.connector
from mysql.connector import Error

def connect_db():
    try:
        # Connect to MySQL database
        connection = mysql.connector.connect(
            host="103.23.199.185",       # Your MySQL server IP
            port=3306,                  # MySQL port
            user="root",                # MySQL username
            password="admin123",        # MySQL password
            database="web-app-dev"      # Your database name
        )

        if connection.is_connected():
            print("Connected to MySQL Database")
            db_info = connection.get_server_info()
            print(f"MySQL Server version: {db_info}")

            # Optional: Test a query
            cursor = connection.cursor()
            cursor.execute("SELECT DATABASE();")
            record = cursor.fetchone()
            print(f"You're connected to database: {record[0]}")

    except Error as e:
        print(f"Error while connecting to MySQL: {e}")
    
    finally:
        # Close the connection
        if 'connection' in locals() and connection.is_connected():
            cursor.close()
            connection.close()
            print("MySQL connection is closed")

# Call the function
connect_db()
