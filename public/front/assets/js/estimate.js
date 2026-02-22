let cart=JSON.parse(localStorage.getItem('estimate_cart'))||[];function addToQuote(productData){const{id,name,isSized}=productData;let item={id:Date.now(),product_id:id,name:name,isSized:isSized};if(isSized){const lengthInput=document.getElementById(`len-${id}`);const widthInput=document.getElementById(`wid-${id}`);const L=parseFloat(lengthInput.value);const W=parseFloat(widthInput.value);if(!L||!W||L<=0||W<=0){alert("Please enter valid Length and Width.");return}
item.length=L;item.width=W;item.area=L*W;item.qty=null;lengthInput.value="";widthInput.value=""}else{const qtyInput=document.getElementById(`qty-${id}`);const Q=parseInt(qtyInput.value);if(!Q||Q<=0){alert("Please enter a valid quantity.");return}
item.qty=Q;item.area=0;item.length=null;item.width=null;qtyInput.value=""}
cart.push(item);saveAndRender()}
function removeFromQuote(uniqueId){cart=cart.filter(item=>item.id!==uniqueId);saveAndRender()}
function saveAndRender(){localStorage.setItem('estimate_cart',JSON.stringify(cart));renderCart()}
function renderCart(){const listElement=document.getElementById("quoteList");const totalAreaElement=document.getElementById("totalArea");if(!listElement||!totalAreaElement)return;listElement.innerHTML="";let totalArea=0;if(cart.length===0){listElement.innerHTML=`<li class="empty-cart-msg">No items added yet.</li>`;totalAreaElement.textContent="0 sq ft";return}
cart.forEach(item=>{totalArea+=(item.area||0);const li=document.createElement("li");li.className="quote-item";const detailText=item.isSized?`${item.length}' x ${item.width}' (${item.area.toFixed(2)} sq ft)`:`${item.qty} pcs`;li.innerHTML=`
            <div class="quote-item-info">
                <strong>${item.name}</strong>
                <span class="quote-item-dims">${detailText}</span>
            </div>
            <i class="fas fa-times remove-btn" onclick="removeFromQuote(${item.id})" style="cursor:pointer; color:red;"></i>
        `;listElement.appendChild(li)});totalAreaElement.textContent=totalArea.toLocaleString("en-US")+" sq ft"}
function createHiddenInput(container,name,value){let input=document.createElement("input");input.type="hidden";input.name=name;input.value=value;container.appendChild(input)}
document.addEventListener("DOMContentLoaded",function(){renderCart();const quoteForm=document.getElementById("quoteForm");let hiddenContainer=document.getElementById("hidden-cart-inputs");if(quoteForm){quoteForm.addEventListener("submit",function(e){if(cart.length===0){e.preventDefault();alert("Please add at least one product to your list.");return}
if(!hiddenContainer){hiddenContainer=document.createElement("div");hiddenContainer.id="hidden-cart-inputs";quoteForm.appendChild(hiddenContainer)}
hiddenContainer.innerHTML="";cart.forEach((item,index)=>{createHiddenInput(hiddenContainer,`items[${index}][product_id]`,item.product_id);createHiddenInput(hiddenContainer,`items[${index}][length]`,item.length||"");createHiddenInput(hiddenContainer,`items[${index}][width]`,item.width||"");createHiddenInput(hiddenContainer,`items[${index}][qty]`,item.qty||"");createHiddenInput(hiddenContainer,`items[${index}][area]`,item.area||0)});let submitBtn=quoteForm.querySelector("button[type='submit']");if(submitBtn){submitBtn.disabled=!0;submitBtn.innerHTML='Sending... <span class="btn-spinner"></span>';localStorage.removeItem('estimate_cart')}})}})