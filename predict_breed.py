import cv2
import numpy as np
import tensorflow as tf

# Load the pre-trained model
model = tf.keras.applications.ResNet50(weights='imagenet')

# Define a function to preprocess the input image
def preprocess_image(img_path):
    img = cv2.imread(img_path)
    img = cv2.resize(img, (224, 224))
    img = np.expand_dims(img, axis=0)
    img = tf.keras.applications.resnet50.preprocess_input(img)
    return img

# Define a function to predict the dog breed
def predict_breed(img_path):
    img = preprocess_image(img_path)
    preds = model.predict(img)
    breed = tf.keras.applications.resnet50.decode_predictions(preds, top=1)[0][0][1]
    return breed

# Test the function with an example image
img_path = 'D:\Rupesh_dai\Laravel-8-Blog-Tutorial-up-to-Deployment\Pomeranian.jpg'
breed = predict_breed(img_path)
print('The predicted dog breed is', breed)
