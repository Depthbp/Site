from turtle import *
from random import *

shape('turtle')
speed(0)
while True:
    pencolor(randint(0, 255), randint(0, 255), randint(0, 255))
    left(randint(-10, 10))
    forward(1)