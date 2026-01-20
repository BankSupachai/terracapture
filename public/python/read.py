from PIL import Image

import pytesseract
import matplotlib.pyplot as plt
import pydicom
import sys
import os
import io
import base64
import json

def get_files_in_folder(path):
    dir_list = os.listdir(path)
    return dir_list

# HN / studydate / Modality
# 1/20220608/US
folder_part = sys.argv[1]

this_dict = {}


pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract'

folder_path = f"D:/laragon/htdocs/terra/patient/{folder_part}"
files = get_files_in_folder(folder_path)
for file in files:
    if '.dcm' or '.DCM' or '.file' in file:
        ds = pydicom.dcmread(f'{folder_path}/{file}')
        # print(ds)

        fig = plt.figure()
        plt.imshow(ds.pixel_array, cmap=plt.cm.gray)
        plt.axis('off')
        # plt.show()

        data_str = ''
        if ds.pixel_array is not None:
            try:
                path = "D:/laragon/htdocs/endocapture5.0/public/python/graphs"
                # plt.show()

                fig.savefig(f'{path}/test3.jpg', bbox_inches='tight', dpi=300) 
                ocr_txt = pytesseract.image_to_string(Image.open(f'{path}/test3.jpg'))
                arr = ocr_txt.split(' ')

                if arr[0] == 'Patient':
                    for text in arr:
                        if 'LMP:' in text:
                            index = arr.index(text) + 1
                            to_dict = arr[index].replace('\n','').replace('EDD:','')
                            this_dict['LMP'] = to_dict

                        if 'EDD:' in text:
                            index = arr.index(text) + 1
                            to_dict = arr[index].replace('\n','')
                            this_dict['EDD'] = to_dict
                
                elif arr[0] == 'OB:':
                    for text in arr:
                        # print(arr)
                        if 'BPD' in text:
                            index = arr.index(text) + 1 # + to 3
                            to_dict = arr[index].replace('\n','') + ' ' + arr[index+1].replace('\n','') + ' ' + arr[index+2].replace('\n','') + ' ' + arr[index+3].replace('\n','')
                            this_dict['BPD'] = to_dict
                        if 'HC' in text:
                            index = arr.index(text) + 1
                            to_dict = arr[index].replace('\n','') + ' ' + arr[index+1].replace('\n','') + ' ' + arr[index+2].replace('\n','') + ' ' + arr[index+3].replace('\n','')
                            this_dict['HC'] = to_dict
                        if 'AC' in text:
                            index = arr.index(text) + 1
                            to_dict = arr[index].replace('\n','') + ' ' + arr[index+1].replace('\n','') + ' ' + arr[index+2].replace('\n','') + ' ' + arr[index+3].replace('\n','')
                            this_dict['AC'] = to_dict
                        if 'FL' in text:
                            index = arr.index(text) + 1
                            to_dict = arr[index].replace('\n','') + ' ' + arr[index+1].replace('\n','') + ' ' + arr[index+2].replace('\n','').replace('u00e','') 
                            this_dict['FL'] = to_dict
                        if 'EFW' in text:
                            index = arr.index(text) + 1
                            to_dict = arr[index].replace('\n','') + ' ' + arr[index+1].replace('\n','') + ' ' + arr[index+2].replace('\n','') + ' ' + arr[index+3].replace('\n','').replace('OB:','')
                            this_dict['EFW'] = to_dict

                plt.close(fig) 

                json_object = json.dumps(this_dict) 


            except:
                print('error', file)

print(json_object)


