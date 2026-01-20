import asyncio
from pyppeteer import launch
import time
import json
import os
import sys
from pymongo import MongoClient

cid = sys.argv[1]

def get_key(table, key):
    row = table.find({'id':1})
    value = ''
    for doc in row:
        if doc.get(key) is not None:
            value = doc.get(key)
    return value

root_path    = os.path.dirname(__file__)
config_path  = f'{root_path}\\mongo_config.json'
config_data  = ''
with open(config_path, 'r') as file:
    config_data = json.load(file)
config = config_data[0]

if config['auth'].lower() == 'true':
    conn_str = f"mongodb://{config['username']}:{config['password']}@{config['host']}:{config['port']}"
else:
    conn_str = f"mongodb://{config['host']}:{config['port']}"

client      = MongoClient(conn_str)
db          = client['endoindex']
table       = db['tb_temppdf']

hn          = get_key(table, 'hn')
folderdate  = get_key(table, 'folderdate')
datetime    = get_key(table, 'datetime')

async def generate_pdf(url, pdf_path):
    browser = await launch()
    page = await browser.newPage()
    time.sleep(1)
    await page.goto(url)
    await page.pdf({'path': pdf_path, 'format': 'A4'})
    await browser.close()

folder_path = f"D:/laragon/htdocs/store/{hn}/{folderdate}/pdf"
if not os.path.exists(folder_path):
    os.makedirs(folder_path)

print(f'{folder_path}/nurse_{hn}_{folderdate}.pdf')
# url = 'http://localhost/endoindex/api/nursereport/'+cid
url = 'http://localhost/endoindex/note/paper/'+cid
# Run the function
asyncio.get_event_loop().run_until_complete(generate_pdf(url, f'{folder_path}/nurse_{hn}_{folderdate}.pdf'))
# asyncio.get_event_loop().run_until_complete(generate_pdf('http://localhost/endoindex/nursereport', f'D:/laragon/htdocs/store/nurse_report.pdf'))
