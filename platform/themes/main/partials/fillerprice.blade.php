<div class=" gainprice">
  
    <div class="range-slider">
      <span id="rs-bullet" class="rs-label">0 Đ</span>
      <input id="rs-range-line" class="rs-range" type="range" value="0" min="0" max="200">
      
    </div>
    
    <div class="box-minmax">
      <span>0 Đ</span><span>200 Đ</span>
    </div>
    
  </div>

<script>
 var rangeSlider = document.getElementById("rs-range-line");
var rangeBullet = document.getElementById("rs-bullet");

rangeSlider.addEventListener("input", showSliderValue, false);

function showSliderValue() {
  rangeBullet.innerHTML = rangeSlider.value;
  var bulletPosition = (rangeSlider.value /rangeSlider.max);
  rangeBullet.style.left = (bulletPosition * 578) + "px";
}
</script>