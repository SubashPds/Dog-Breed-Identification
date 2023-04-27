import numpy as np
import matplotlib.pyplot as plt
from PIL import Image
from keras.models import load_model
import sys

model = load_model('D:\\Rupesh_dai\\Laravel-8-Blog-Tutorial-up-to-Deployment\\model4.h5')

# Load the image using PIL
test_image = Image.open(sys.argv[1])
# test_image = Image.open('D:\\Rupesh_dai\\Dog-Breed-prediction\\download (3).jpeg')


test_image = test_image.resize((100, 100))
# imageplot = plt.imshow(test_image)

x = np.array(test_image)
x = np.expand_dims(x, axis=0)
images = np.vstack([x])

result = model.predict(images, batch_size=10)

# Print the predicted breed
if result[0][0] == 1:
    print("This is a Pug")
elif result[0][1] == 1:
    print("This is a Japanese spaniel")
elif result[0][2] == 1:
    print("This is a Chow")
# elif result[0][3] == 1:
#     print("This is human")
else:
    print("Sorry I cannot identify that image")
