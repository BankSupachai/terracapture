# pip install matplotlib
# pip install numpy
import matplotlib.pyplot as plt
import numpy as np
import json
import datetime
import os
import sys
import io
import base64
#  ผ่าน command line (type-str)
pointx = sys.argv[1]
pointy = sys.argv[2]
chart_type = sys.argv[3]

# chart_type="biparietal"
# chart_type="headcircumference"
# chart_type="abdominalcircumference"
# chart_type="femurlength"
# chart_type="estimatedfetalweight"
# chart_type="amnioticfluidindex"
# chart_type="afmvp"
# chart_type="occipitofrontaldiameter"
# chart_type="hcac"
# chart_type="cephalicindex"
# chart_type="flbpd"
# chart_type="flhc"
# chart_type="umbilicalarterypulsatilityindex"
# chart_type="umbilicalarteryresistanceindex"
# chart_type="umbilicalaps"
# chart_type="umbilicaltamax"
# chart_type="umbilicalarterysoratio"
# chart_type="rtmcapi"
# chart_type="rtmcari"
# chart_type="rtmcaps"

# ct stores current time
now = datetime.datetime.now()
date = now.strftime("%Y-%m-%d")

base_path = "D:/laragon/htdocs/endocapture5.0/public/python"

pathname = open(f"{base_path}/config/config_path.txt", "r")
path_load  = json.loads(pathname.read())

def get_files_in_folder(path):
    dir_list = os.listdir(path)
    return dir_list

def curve_plot(chart_type):
    filename= open(f"{base_path}/config/config_"+chart_type+".txt", "r")
    config  = json.loads(filename.read())

    fig = plt.figure()
    ax  = fig.add_subplot(111) # rol-col-num
    ax.plot(config['x'],config['y95percent'],color='red', linewidth=2)
    ax.plot(config['x'],config['y0percent'] ,color='lightblue', linewidth=2)            
    ax.plot(config['x'],config['y5percent'] ,color='red', linewidth=2)

    if chart_type == 'estimatedfetalweight':
        ax.plot(config['x'],config['y3percent'] ,color='green', linestyle='dashed', linewidth=2)            
        ax.plot(config['x'],config['y97percent'] ,color='green', linestyle='dashed', linewidth=2)
    
    if chart_type == 'hcac' or chart_type == 'flbpd' or chart_type == 'flhc':
        ax.set_xlim(14, 39)
        ax.set_ylim(config['y'][0],config['y'][-1])
    else:
        ax.set_xlim(config['x'][0],config['x'][-1])
        ax.set_ylim(config['y'][0],config['y'][-1])

    plt.plot(int(pointx), int(pointy), '+',color='black', linewidth=2)
    plt.xlabel(config['xlabel'])
    plt.ylabel(config['ylabel'])

    if chart_type == 'hcac' or chart_type == 'flbpd' or chart_type == 'flhc':
        plt.xticks(np.arange(14, 39, 4.0))
    else:
        plt.xticks(config['x'])

    plt.yticks(config['y'])
    plt.grid() 
    # plt.show()

    # path = path_load['path']
    # path = path.replace("\\", "/")

    # isExist = os.path.exists(path)
    # if not isExist:
    #     os.makedirs(path)
    
    # fig.savefig(f'{path}/{chart_type}.jpg') 
    # ---------------------------------------
    buf = io.BytesIO()
    fig.savefig(buf, format="png") 
    plt.close(fig) 
    data = base64.b64encode(buf.getbuffer())
    print(data.decode("utf-8") )

    # io_bytes.seek(0)
    # base64_img = base64.b64encode(io_bytes.getvalue()).decode("utf-8").replace("\n", "")
    # print(f'{base64_img}', type(base64_img))
      
    # plt.close(fig) 

if __name__ == '__main__':
    # สร้างรูปจากกราฟ
    curve_plot(chart_type)
    # print(pointx, pointy, chart_type)
    # print('ggg')


    # uncomment  ด้านล่างหากต้องการสร้างรูปจากกราฟทั้งหมด
    # folder_path = 'D:/laragon/www/playground/python_playground/draw_graph_edit/config'
    # files = get_files_in_folder(folder_path)
    # for file in files:
    #     if file is not 'config_path.txt':
    #         img_name = file.replace('config_','').replace('.txt','')
    #         curve_plot(img_name)



