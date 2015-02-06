function isCanvasSupported(){
  var elem = document.createElement('canvas');
  return (elem.getContext && elem.getContext('2d')) ? true : false;
}