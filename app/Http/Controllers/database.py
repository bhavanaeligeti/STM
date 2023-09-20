import psycopg2
from psycopg2 import Error

# Database connection details
db_host = "your_db_host"
db_port = "your_db_port"
db_name = "your_db_name"
db_user = "your_db_user"
db_password = "your_db_password"

try:
    # Connect to the PostgreSQL database
    connection = psycopg2.connect(
        host=db_host,
        port=db_port,
        database=root,
        user=root,
        password=
    )

    # Create a cursor object to execute SQL queries
    cursor = connection.cursor()

    # Execute a SQL query to create a table
    create_table_query = """
        CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255)
        )
    """
    cursor.execute(create_table_query)

    # Commit the transaction
    connection.commit()

    # Insert some data into the table
    insert_query = "INSERT INTO users (name) VALUES (%s)"
    records_to_insert = [("Alice"), ("Bob"), ("Charlie")]
    cursor.executemany(insert_query, records_to_insert)
    
    # Commit the transaction
    connection.commit()

    # Execute a SQL query to fetch data from the table
    select_query = "SELECT * FROM users"
    cursor.execute(select_query)

    # Fetch all the rows
    rows = cursor.fetchall()
    print("Users:")
    for row in rows:
        print(row)

except Error as e:
    print("Error: ", e)

finally:
    # Close the cursor and connection
    if connection:
        cursor.close()
        connection.close()
        print("Database connection closed.")
