<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        :root {
    --tlt-br-cnt: 50;
    --i: 0;
}

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    width: 100vw;
    height: 100vh;

    background: hsl(216, 28%, 7%);;

    overflow: hidden;

    display: flex;
    justify-content: space-evenly;
    align-items: center;
}

.progress {
    width: 200px;
    height: 200px;
    border-radius: 50%;

    display: flex;
    justify-content: center;
    align-items: center;

    position: relative;
}

.progress i {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    transform: rotate(calc(45deg + calc(calc(360deg / var(--tlt-br-cnt)) * var(--i))));
}

.progress i::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    background: hsla(0, 0%,100%, 12%);;
    width: 5px;
    height: 20px;
    border-radius: 999rem;
    transform: rotate(-45deg);
    transform-origin: top;
    opacity: 0;

    animation: barCreationAnimation 100ms ease forwards;
    animation-delay: calc(var(--i) * 15ms);
}

.progress .selected1::after {
    background: hsl(130, 100%, 50%);
    box-shadow: 0 0 1px hsl(130, 100%, 50%),
                0 0 3px hsl(130, 100%, 30%),
                0 0 4px hsl(130, 100%, 10%);
}

.progress .selected2::after {
    background: hsl(64, 100%, 50%);
    box-shadow: 0 0 1px hsl(64, 100%, 50%),
                0 0 3px hsl(64, 100%, 30%),
                0 0 4px hsl(64, 100%, 10%);
}

.progress .selected3::after {
    background: hsl(8, 100%, 50%);
    box-shadow: 0 0 1px hsl(8, 100%, 50%),
                0 0 3px hsl(8, 100%, 30%),
                0 0 4px hsl(8, 100%, 10%);
}

.percent-text {
    font-size: 3rem;
    animation: barCreationAnimation 500ms ease forwards;
    animation-delay: calc(var(--tlt-br-cnt) * 15ms / 2);
}

.text1{
    color: hsl(130, 100%, 50%);
    text-shadow: 0 0 1px hsl(130, 100%, 50%),
                    0 0 3px hsl(130, 100%, 30%),
                    0 0 4px hsl(130, 100%, 10%);
    opacity: 0;
}

.text2{
    color: hsl(64, 100%, 50%);
    text-shadow: 0 0 1px hsl(64, 100%, 50%),
                0 0 3px hsl(64, 100%, 30%),
                0 0 4px hsl(64, 100%, 10%);
    opacity: 0;
}
.text3{
    color: hsl(8, 100%, 50%);
    text-shadow: 0 0 1px hsl(8, 100%, 50%),
    0 0 3px hsl(8, 100%, 30%),
    0 0 4px hsl(8, 100%, 10%);
    opacity: 0;
}

@keyframes barCreationAnimation {
    from {opacity: 0}
    to {opacity: 1}
}
    </style>
</head>
<body>
    <div class="progress"></div>
</body>
<script>
    const wrapper = document.querySelectorAll('.progress');

const barCount = 50;
const percent1 = 50 * 90/100;
const percent2 = 50 * 60/100;
const percent3 = 50 * 30/100;

for (let index = 0; index < barCount; index++) {
    const className = index < percent1 ? 'selected1' : '';
    wrapper[0].innerHTML += `<i style="--i: ${index};" class="${className}"></i>`;
}

wrapper[0].innerHTML += `<p class="selected percent-text text1">90%</p>`
</script>
</html>