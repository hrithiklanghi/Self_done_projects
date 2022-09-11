from flask import Flask, request, render_template, jsonify
import os
import urllib.request
from werkzeug.utils import secure_filename
import pytesseract
import cv2
import string
import numpy as np
import matplotlib.pyplot as plt
from solvin_functions import *



app = Flask(__name__)

UPLOAD_FOLDER =r'/home/hrithik/Documents/Masai/Sudoku/new_start/uploads/'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['MAX_CONTENT_LENGTH'] = 16 * 1024 * 1024

@app.route('/')
def index():
  return render_template('new_index.html')

filename_org=""
@app.route('/upload', methods=['POST'])
def upload_file():
	if 'files[]' not in request.files:
		resp=jsonify({'message':'No file part in the request'})
		resp.status_code=400
		return resp
	
	files= request.files.getlist('files[]')
	
	errors={}
	success=False

	if len(files)>1:
		errors['message'] = 'Please select only one file.'
		resp = jsonify(errors)
		resp.status_code = 206
		return resp
	        
	filename= secure_filename(files[0].filename)
	filename_org="/".join([r"/home/hrithik/Documents/Masai/Sudoku/new_start/uploads", "temp.jpeg"])
	
	files[0].save(filename_org)
	success=True
	print(filename_org)
	

	if success:
	        resp = jsonify({'message' : 'Files successfully uploaded'})
	        resp.status_code = 201
	        return resp
	else:
	        resp = jsonify(errors)
	        resp.status_code = 400
	        return resp
		
@app.route('/scan_fun')
def scan_fun():
	imCrop=cv2.imread("/home/hrithik/Documents/Masai/Sudoku/new_start/uploads/temp.jpeg")
	print(type(imCrop))
	#cv2.imshow("Scanned Image", imCrop)
	img_RGB=cv2.cvtColor(imCrop, cv2.COLOR_BGR2RGB)
	edges = cv2.Canny(img_RGB, 100, 200) # Canny Edge Detection
	
	contours, hierarchy = cv2.findContours(image=edges, mode=cv2.RETR_TREE, method=cv2.CHAIN_APPROX_NONE)
				            
	image_copy = imCrop.copy()
	cv2.drawContours(image=image_copy, contours=contours, contourIdx=-1, color=(0, 255, 0), thickness=2, lineType=cv2.LINE_AA)
	cv2.destroyAllWindows()
	
	imgwidth=imCrop.shape[0]
	imgheight=imCrop.shape[1]
	
	M = imgheight//9
	N = imgwidth//9
	
	for y in range(0,imgheight,M):
		for x in range(0, imgwidth, N):
			new_img=img_RGB[y:y+M,x:x+N]
			if(new_img.shape[0]==M and new_img.shape[1]==N):
				status=cv2.imwrite("save/" + str(y//M) + '_' + str(x//N)+".jpg", new_img)
				print("Image written to file-system : ",status)
	
	store_out={}
	for t in range(0,9,1):
		for u in range(0,9,1):
			nam="save/" + str(t) + '_' + str(u) + ".jpg"
			target = pytesseract.image_to_string(nam,config='--psm 10 --dpi 80 -c tessedit_char_whitelist=123456789')
			
			store_out[(t*9)+u]=target[0]
	filtered={}
	for s in range(0,81):
		res=store_out[s].isprintable()
	    
		if res == True:
			filtered[s]=store_out[s]
		else:
			filtered[s]='0'
		
	mat_row=np.ndarray((9, 9), dtype='int')
	mat_col=np.ndarray((9, 9), dtype='int')
	k=0
	for i in range(0, 9):
		for j in range(0, 9):
			mat_row[i][j]=filtered[k]
			mat_col[j][i]=filtered[k]
			k+=1
		
	print(mat_row)
	return str(mat_row)
	
@app.route('/solveit', methods=['POST'])
def solveit():
	data_matrix=request.json
	pass_matrix=np.ndarray((9, 9), dtype='int')
	for i in range(len(data_matrix[0])):
		for j in range(len(data_matrix)):
			pass_matrix[i][j]=int(float(data_matrix[i][j]))
		
	success=False
	valid=validity(pass_matrix)
	if valid:
		solveSudoku(pass_matrix)
		printsudoku(pass_matrix)
		print(str(pass_matrix))
		return str(pass_matrix)
	else:
		#error_at=validity(pass_matrix)
		errors = {"message":"The above sudoku doesn't have a solution."}
		resp = jsonify(errors)
		resp.status_code = 206
		return resp
		

if __name__ == '__main__':
  app.run(debug=True)
