import turtle
import random

r = random.randint(0,255)
g = random.randint(0,255)
b = random.randint(0,255)

t = turtle.Turtle()

t.shape('turtle')

t.pensize(25)

t.color((r,g,b))

t.speed(0)

while True:
    t.forward(random.randint(1,100))
    t.right(random.randint(1,100))
    
    if t.xcor() > 400 or t.ycor() < -400:
        t.goto(0,0)
    if t.xcor() > 400 or t.xcor() < -400:
        t.goto(0,0)