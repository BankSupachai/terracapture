import asyncio
from pyppeteer import launch
import time
import json
import os
import sys
from pymongo import MongoClient

cid         = sys.argv[1]
hn          = sys.argv[2]
folderdate  = sys.argv[3]

# hn = "222"
# folderdate = "2024-05-17"

async def generate_pdf(url, pdf_path):
    browser = await launch()
    page = await browser.newPage()
    await page.goto(url)
    time.sleep(2)
    await page.pdf({'path': pdf_path, 'format': 'A3'})
    await browser.close()

folder_path = f"D:/laragon/htdocs/store/{hn}/{folderdate}/pdf"
if not os.path.exists(folder_path):
    os.makedirs(folder_path)

# url = 'http://localhost/endoindex/note/paper/'+cid
url = "http://localhost/endoindex/note/paper?nid="+ cid
# url = 'http://localhost/endoindex/note/paper/65fba041a24d45786c04013'
asyncio.get_event_loop().run_until_complete(generate_pdf(url, f'{folder_path}/nurse_{hn}_{folderdate}.pdf'))
