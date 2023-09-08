from email import message
import requests
import logging
import urllib.request
import datetime
from telegram.ext import Updater, CommandHandler, MessageHandler, Filters, ConversationHandler, filters
import ssl
import json
import os

ssl._create_default_https_context = ssl._create_unverified_context
# Enable logging
logging.basicConfig(format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
                    level=logging.INFO)

array_sentence = []
array_message = []
logger = logging.getLogger(__name__)
GENDER, PHOTO, LOCATION, BIO = range(4)

def photo(update, context): 

    x = datetime.datetime.now()
    month = x.month
    str_month = str(month)
    day = x.day
    str_day = str(day)

    if(month<10):
        str_month = '0'+str_month
    
    if(day<10):
        str_day = '0'+str_day
    
    message = update.message

    photo_file = update.message.photo[-1].get_file().file_path
    sentence = message.caption
    array_sentence = sentence.rsplit('\n', 4)
    try :
        witel =  array_sentence[0]
        link =  array_sentence[1]
        report = array_sentence[2]
        name = array_sentence[3]
        phone_number = array_sentence[4]
    except :
        user = update.message.from_user
        update.message.reply_text("FORMAT SALAH "+user.first_name+", Data GAGAL disimpan")
    id = message.from_user.id
    print(id)

    #Post ke Database
    check_phone_number = phone_number.startswith("0")  
    if(check_phone_number):
        phone_number = phone_number.replace(' ','')
        phone_number = phone_number.replace('-', '')
        photo_name = "assets/upload/cut/"+phone_number+str(x.year)+"-"+str_month+"-"+str_day+".jpg"
        url = 'http://10.16.110.100/frotect/api/cut/report'
        myobj = {
            'id_telegram': id,
            'name': name,
            'phone_number': phone_number,
            'witel': witel,
            'link': link,
            'report': report,
            'photo': photo_name,
            'date': str(x.year)+"-"+str_month+"-"+str_day
        }
        print(myobj)
        x = requests.post(url, data = myobj)
        print(x)
        data = json.loads(x.text)
        print(data)
        message = data['message']
        if data['status'] == 'error':
            user = update.message.from_user
            update.message.reply_text("Data laporan sebelumnya sudah ada "+user.first_name+". Terima kasih")
            print("Data sudah ada")
        elif data['status'] == 'success':
            response = requests.get(photo_file)

            path = '../assets/upload/cut'
            if not os.path.exists(path):
                os.makedirs(path)

            if os.path.isdir(path):
                print("Direktori ada")
                if os.access(path, os.W_OK):
                    print("Write access granted")
                else:
                    print("Write access denied")
            else:
                print("Direktori tidak ditemukan")
            with open('../'+photo_name, 'wb') as f:
                f.write(response.content)
            user = update.message.from_user
            update.message.reply_text("Terima Kasih "+user.first_name+", Data berhasil disimpan")
        else:
            user = update.message.from_user
            update.message.reply_text("Maaf, Server Sibuk "+user.first_name+" Tolong diposting ulang lagi.")
              
    else : 
        user = update.message.from_user
        update.message.reply_text("FORMAT SALAH "+user.first_name+", Data GAGAL disimpan")

def main():
    updater = Updater("6618969009:AAF3E_B1S2D7VvM8he-O5zvUpk_S43QnWqs", use_context=True)
    dp = updater.dispatcher
    dp.add_handler(MessageHandler(Filters.photo, photo))
    updater.start_polling()
    updater.idle()

if __name__ == '__main__':
    main()
