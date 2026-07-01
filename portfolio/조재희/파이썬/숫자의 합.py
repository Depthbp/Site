n = int(input())
sum = 0
l = list(map(int, input()))

for i in range(n):
    sum += l[i]

print(sum)