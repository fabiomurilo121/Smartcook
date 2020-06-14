from os import listdir

import cv2
from keras.preprocessing import image
from keras.applications.inception_v3 import InceptionV3, preprocess_input
from keras.applications.xception import Xception
import numpy as np
from joblib import dump, load
import os.path
import glob

class_names=['Alho','Azeite','Banana','Batata','Cebola','Leite integral','Ovo galinha']

#funcao para listar arquivos de um diretorio
def listar_arquivos(caminho=None):
    lista_arqs = [arq for arq in listdir(caminho)]
    return lista_arqs

#funcao para entrar com imagem nova
def extrairImg(imgg):
  model = Xception(include_top=False, weights='imagenet', pooling='avg')
  X_deep = []
  imagem = cv2.imread(imgg)
  #altura, largura,  = imagem.shape
  img = cv2.resize(imagem,(299,299))
  xd = image.img_to_array(img)
  xd = np.expand_dims(xd, axis=0)
  xd = preprocess_input(xd)
  deep_features = model.predict(xd)
  #return deep_features
  X_image_aux = []
  for aux in deep_features:
      X_image_aux = np.append(X_image_aux, np.ravel(aux))
  deep_features = [i for i in X_image_aux]
  X_deep.append(deep_features)
  return X_deep

#Aqui voce muda o path
with open("salvamento_codigo.mod", 'rb') as fo:
  clfSalvo = load(fo)

while True:
    if len(os.listdir('C:/wamp64/www/usuario/uploads/')) == 0:
        ()
        #print("Directory is empty")
    else:
        print("Directory is not empty")
        lista_fotos = listar_arquivos('C:/wamp64/www/usuario/uploads/')
        cont = -1
        limite = len(lista_fotos)
        while limite > 0:
          cont += 1
          print()
          imagemAtual = 'C:/wamp64/www/usuario/uploads/' + lista_fotos[cont]
          print(imagemAtual)
          X_ImgNova = extrairImg(imagemAtual)
          predicted=clfSalvo.predict(X_ImgNova)
          predp=clfSalvo.predict_proba(X_ImgNova)
          indiceAtual = -1
          print(class_names[predicted[0]])
          file = open('correspondente_img.txt', 'w')
          file.write(class_names[predicted[0]])
          file.close()
          lista_fotos.pop()
          os.remove(imagemAtual)
          limite = limite - 1
'''
X_ImgNova = extrairImg('testeAlho.jpg')
#antes usava clfa.predict
predicted=clfSalvo.predict(X_ImgNova)
#predict proca te da o suporte para decisao(probabilidade da decisao estar certa)
predp=clfSalvo.predict_proba(X_ImgNova)

indiceAtual = -1
for maiores in predp[0]:
  indiceAtual += 1
  if predp[0][indiceAtual]>0:
    if predp[0][indiceAtual]<1:
      print("Possível resultado: ", class_names[indiceAtual], "(probabilidade de ", (predp[0][indiceAtual])*100,"%)")
    else:
      print("Maior similaridade com: ", class_names[predicted[0]], "\n")

print(predp)
print(class_names)
'''
