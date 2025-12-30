function a() {
  setTimeout(b, 10);
}

function b() {
  throw new Error('i forgot');
}

a();