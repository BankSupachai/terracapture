/*
 *  Copyright (c) 2015 The WebRTC project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a BSD-style license
 *  that can be found in the LICENSE file in the root of the source
 *  tree.
 */

'use strict';

const dimensions = document.querySelector('#dimensions');
const video = document.querySelector('video');
let stream;

const fullHdButton = document.querySelector('#full-hd');

const videoblock = document.querySelector('#videoblock');
const messagebox = document.querySelector('#errormessage');

const widthInput = document.querySelector('div#width input');
const widthOutput = document.querySelector('div#width span');
const aspectLock = document.querySelector('#aspectlock');
const sizeLock = document.querySelector('#sizelock');

let currentWidth = 0;
let currentHeight = 0;


fullHdButton.onclick = () => {
  getMedia(fullHdConstraints);
};




const fullHdConstraints = {
  video: {width: {exact: 1920}, height: {exact: 1080}}
};

function gotStream(mediaStream) {
  stream = window.stream = mediaStream; // stream available to console
  video.srcObject = mediaStream;
  messagebox.style.display = 'none';
  videoblock.style.display = 'block';
  const track = mediaStream.getVideoTracks()[0];
  const constraints = track.getConstraints();
  console.log('Result constraints: ' + JSON.stringify(constraints));
  if (constraints && constraints.width && constraints.width.exact) {
    widthInput.value = constraints.width.exact;
    widthOutput.textContent = constraints.width.exact;
  } else if (constraints && constraints.width && constraints.width.min) {
    widthInput.value = constraints.width.min;
    widthOutput.textContent = constraints.width.min;
  }
}

function errorMessage(who, what) {
  const message = who + ': ' + what;
  messagebox.innerText = message;
  messagebox.style.display = 'block';
  console.log(message);
}

function clearErrorMessage() {
  messagebox.style.display = 'none';
}

function displayVideoDimensions(whereSeen) {
  if (video.videoWidth) {
    dimensions.innerText = 'Actual video dimensions: ' + video.videoWidth +
      'x' + video.videoHeight + 'px.';
    if (currentWidth !== video.videoWidth ||
      currentHeight !== video.videoHeight) {
      console.log(whereSeen + ': ' + dimensions.innerText);
      currentWidth = video.videoWidth;
      currentHeight = video.videoHeight;
    }
  } else {
    dimensions.innerText = 'Video not ready';
  }
}

video.onloadedmetadata = () => {
  displayVideoDimensions('loadedmetadata');
};

video.onresize = () => {
  displayVideoDimensions('resize');
};

function constraintChange(e) {
  widthOutput.textContent = e.target.value;
  const track = window.stream.getVideoTracks()[0];
  let constraints;
  if (aspectLock.checked) {
    constraints = {
      width: {exact: e.target.value},
      aspectRatio: {
        exact: video.videoWidth / video.videoHeight
      }
    };
  } else {
    constraints = {width: {exact: e.target.value}};
  }
  clearErrorMessage();
  console.log('applying ' + JSON.stringify(constraints));
  track.applyConstraints(constraints)
      .then(() => {
        console.log('applyConstraint success');
        displayVideoDimensions('applyConstraints');
      })
      .catch(err => {
        errorMessage('applyConstraints', err.name);
      });
}

widthInput.onchange = constraintChange;

sizeLock.onchange = () => {
  if (sizeLock.checked) {
    console.log('Setting fixed size');
    video.style.width = '100%';
  } else {
    console.log('Setting auto size');
    video.style.width = 'auto';
  }
};

function getMedia(constraints) {
  if (stream) {
    stream.getTracks().forEach(track => {
      track.stop();
    });
  }

  clearErrorMessage();
  videoblock.style.display = 'none';
  navigator.mediaDevices.getUserMedia(constraints)
      .then(gotStream)
      .catch(e => {
        errorMessage('getUserMedia', e.message, e.name);
      });
}
