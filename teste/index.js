let url =
  "https://gustavosjob.ga/contact.html?envio=bem_sucedido?2222222222?333333333?44444444?555555555?6666666?7777";

url = url.split("?");
console.log(url.length);

let i2 = url.map((i) => {
    console.log(i)
    ii = i + 'a'
    console.log(ii)
    return ii
})
console.log(i2)

console.log('----------"-------------');
