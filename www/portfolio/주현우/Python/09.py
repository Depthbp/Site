with open("sample.txt", "w") as f: #쓰기 모드
    f.write("Hello DEPTH club!\n")
    
with open("sample.txt", "r") as f: # 읽기 모드
    text = f.read()
    print(text) # 파일 내용 출력