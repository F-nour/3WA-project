"use strict";

// objects

const TIMER = {
  sec: 16,
};

// global variables

let timeOutId;
let second = "00"

const time = document.getElementById('redirection');


// calculation functions

const numberToString = (number, string) => {
  if (number < 10) {
    string = `0${number}`
  } else {
    string = `${number}`
  }
  return string
};

const updateView = () => {
  let unit = 'secondes'
  if (TIMER.sec < 2) {
    unit = 'seconde'
  }
  const secondString = numberToString(TIMER.sec, second)
  const text = (time.innerText = `${secondString} ${unit}`)
  return text
};


// stopwatch events

export const timer = () => {
  if (time !== null) {
    if (timeOutId) {
      clearTimeout (timeOutId)
    }
    TIMER.sec--
    timeOutId = setTimeout (timer, 1000)
    const text = updateView ()
    time.innerText = `${text}`
  }
}
