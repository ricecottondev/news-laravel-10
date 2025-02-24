<button onclick="topFunction()" id="myBtn" title="Go to top text-center m-3" class="btn lh-1">
   <i class="bi bi-chevron-compact-up fs-3"></i>
   <div style="transform: translateY(-25%);">Top</div>
</button>
<style>
   #myBtn {
      display: none;
      position: fixed;
      bottom: calc(55px + 1vw);
      right: calc(.5rem + 1vw);
      z-index: 99;
      background-color: #323232;
      color: white;
   }

   #myBtn:hover {
      background-color: #fd4f00;
   }
</style>
<script>
   let mybutton = document.getElementById("myBtn");

   window.onscroll = function() {
      scrollFunction()
   };

   function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
         mybutton.style.display = "block";
      } else {
         mybutton.style.display = "none";
      }
   }

   function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
   }
</script>