with open("sample.txt", "w") as f:
    f.write("Hello DEPTH club!\n")
    
with open("sample.txt", "r") as f:
    text = f.read()
    print(text)