import turtle
turtle.Screen().setup(1.0, 1.0)

t = turtle.Turtle()
t.shape('turtle')

for i in range(8):
    for j in range(4):
        t.forward(200)
        t.left(90)
    t.left(45)

import turtle
turtle.Screen().setup(1.0, 1.0)

t = turtle.Turtle()

t.shape('turtle')
t.right(90)
t.forward(60)
t.right(90)
t.forward(60)
for i in range(2):
    t.left(90)
    t.forward(60)
    t.right(90)
    t.forward(20)
t.left(90)
t.forward(60)
t.left(90)
t.forward(200)
t.left(90)
t.forward(60)
t.left(90)
t.forward(180)
t.backward(160)
t.right(90)
t.forward(60)
t.left(90)
t.forward(140)
t.backward(120)
t.right(90)
t.forward(60)
t.left(90)
t.forward(60)