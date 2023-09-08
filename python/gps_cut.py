from email import message
import requests
import logging
import urllib.request
import datetime
from telegram.ext import Updater, CommandHandler, MessageHandler, ConversationHandler, filters
import json


# Enable logging
logging.basicConfig(format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
                    level=logging.INFO)

array_sentence = []
array_message = []
logger = logging.getLogger(__name__)
GENDER, PHOTO, LOCATION, BIO = range(4)


def location(update, context):
    # get location from live location user sent and send it to the server every 5 minutes
    message = None

    if update.edited_message:
        message = update.edited_message
    else:
        message = update.message

    current_pos = (message.location.latitude, message.location.longitude)
    id = message.from_user.id
    
    urlSend = 'http://10.16.110.100/frotect/api/cut/location'
    myobjSend = {
            'id_telegram': id,
            'lat': message.location.latitude,
            'long': message.location.longitude,
        }
    xSend = requests.post(urlSend, data = myobjSend)
    dataSend = json.loads(xSend.text)
    print(dataSend)

def main():
    # Create the Updater and pass it your bot's token.
    updater = Updater('6630634372:AAFQH_8O4essplqkcgNFZpx-TgH31LqIqCY', use_context=True)

    # Get the dispatcher to register handlers
    dp = updater.dispatcher

    # on different commands - answer in Telegram
    dp.add_handler(MessageHandler(filters.Filters.location, location))

    # Start the Bot
    updater.start_polling()

    # Run the bot until you press Ctrl-C or the process receives SIGINT,
    # SIGTERM or SIGABRT. This should be used most of the time, since
    # start_polling() is non-blocking and will stop the bot gracefully.
    updater.idle()


if __name__ == '__main__':
    main()