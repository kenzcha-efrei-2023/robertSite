import psycopg2
import random

conn = psycopg2.connect('user=pi password=projetTransverse2020 dbname=robert')
cur = conn.cursor()
num = random.choices([0,1,2,3,4,5,6,7,8,9,19])
cur.execute("insert into test(nombre) values("+str(num[0])+")")
conn.commit()
conn.close()