$(document).ready(function () {
  build()
  function build(mode) {
    $(".main").load("construto.php?mode=" + mode)
  }
  $("#btn-login").click(function(){
    console.log('clicado');
  });
  // $("#btn-login").on("click", function () {
  //   console.log("clicado")
  // })
})
