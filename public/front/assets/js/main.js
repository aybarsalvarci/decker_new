document.addEventListener("DOMContentLoaded",function(){let lastScrollTop=0;let scrollThreshold=50;function handleScroll(){let currentScroll=window.scrollY;if(currentScroll>scrollThreshold){document.body.classList.add("scroll-active")}else{document.body.classList.remove("scroll-active");document.body.classList.remove("scroll-down");document.body.classList.remove("scroll-up");lastScrollTop=currentScroll;return}
if(currentScroll>lastScrollTop){document.body.classList.add("scroll-down");document.body.classList.remove("scroll-up")}else{document.body.classList.remove("scroll-down");document.body.classList.add("scroll-up")}
lastScrollTop=currentScroll}
handleScroll();window.addEventListener("scroll",handleScroll);let mobileToggle=document.querySelector(".mobile-toggle");let mobileSidebar=document.querySelector(".mobile-sidebar");let mobileOverlay=document.querySelector(".mobile-menu-overlay");let mobileClose=document.querySelector(".mobile-close");function closeMobileMenu(){if(mobileSidebar&&mobileOverlay){mobileSidebar.classList.remove("active");mobileOverlay.classList.remove("active");document.body.style.overflow=""}}
if(mobileToggle){mobileToggle.addEventListener("click",function(e){e.preventDefault();if(mobileSidebar&&mobileOverlay){mobileSidebar.classList.add("active");mobileOverlay.classList.add("active");document.body.style.overflow="hidden"}})}
if(mobileClose){mobileClose.addEventListener("click",closeMobileMenu)}
if(mobileOverlay){mobileOverlay.addEventListener("click",closeMobileMenu)}
document.addEventListener("keydown",function(e){if(e.key==="Escape"&&mobileSidebar&&mobileSidebar.classList.contains("active")){closeMobileMenu()}});let slides=document.querySelectorAll(".slide");let nextBtn=document.getElementById("nextBtn");let prevBtn=document.getElementById("prevBtn");if(slides.length>0){let currentSlide=0;let autoSlideInterval;function showSlide(index){slides.forEach((slide)=>slide.classList.remove("active"));let currentVideo=slides[currentSlide].querySelector("video");if(currentVideo){currentVideo.pause();currentVideo.currentTime=0}
currentSlide=index>=slides.length?0:index<0?slides.length-1:index;slides[currentSlide].classList.add("active");let newVideo=slides[currentSlide].querySelector("video");if(newVideo){let playPromise=newVideo.play();if(playPromise!==undefined){playPromise.catch(()=>{newVideo.muted=!0;newVideo.play()})}}}
function startAutoSlide(){autoSlideInterval=setInterval(()=>showSlide(currentSlide+1),7000)}
function resetAutoSlide(){clearInterval(autoSlideInterval);startAutoSlide()}
if(nextBtn){nextBtn.addEventListener("click",()=>{showSlide(currentSlide+1);resetAutoSlide()})}
if(prevBtn){prevBtn.addEventListener("click",()=>{showSlide(currentSlide-1);resetAutoSlide()})}
startAutoSlide()}
let newsTrack=document.querySelector(".news-track");let newsCards=document.querySelectorAll(".news-card");let nextNews=document.querySelector(".next-news");let prevNews=document.querySelector(".prev-news");if(newsTrack&&newsCards.length>0){let newsIndex=0;function getVisibleCards(){return window.innerWidth>=992?3:window.innerWidth>=768?2:1}
function updateNewsSlider(){if(newsCards.length===0)return;getVisibleCards();let cardWidth=newsCards[0].offsetWidth;let translateX=(cardWidth+40)*newsIndex;newsTrack.style.transform=`translateX(-${translateX}px)`}
if(nextNews){nextNews.addEventListener("click",()=>{let visibleCards=getVisibleCards();if(newsIndex<newsCards.length-visibleCards){newsIndex++}else{newsIndex=0}
updateNewsSlider()})}
if(prevNews){prevNews.addEventListener("click",()=>{if(newsIndex>0){newsIndex--}
updateNewsSlider()})}
window.addEventListener("resize",()=>{let visibleCards=getVisibleCards();if(newsIndex>newsCards.length-visibleCards){newsIndex=Math.max(0,newsCards.length-visibleCards)}
updateNewsSlider()})}
const langDropdown=document.querySelector('.lang-dropdown');if(!langDropdown)return;langDropdown.querySelector('.current-lang').addEventListener('click',function(e){e.stopPropagation();langDropdown.classList.toggle('active')});document.addEventListener('click',function(){langDropdown.classList.remove('active')});langDropdown.querySelector('.lang-options').addEventListener('click',function(e){e.stopPropagation()})})