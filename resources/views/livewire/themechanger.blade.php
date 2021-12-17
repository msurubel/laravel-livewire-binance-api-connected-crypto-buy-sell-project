<div>
            @if(auth()->user()->theme_set == 1)
                <!--------------------
              START - Color Scheme Toggler
              -------------------->
              <div wire:click="changetheme(2)" onclick="loadfullbody(this)" class="floated-colors-btn second-floated-btn">
                <div class="os-toggler-w">
                  <div wire:click="changetheme(2)" onclick="loadfullbody(this)" class="os-toggler-i">
                    <div class="os-toggler-pill"></div>
                  </div>
                </div>
                <span>Dark </span><span>Colors</span>
              </div>
              <!--------------------
              END - Color Scheme Toggler
              -------------------->
              @else
              <!--------------------
              START - Color Scheme Toggler
              -------------------->
              <div wire:click="changetheme(1)" onclick="loadlink(this)" class="floated-colors-btn second-floated-btn">
                <div class="os-toggler-w on">
                  <div wire:click="changetheme(1)" onclick="loadlink(this)" class="os-toggler-i">
                    <div class="os-toggler-pill"></div>
                  </div>
                </div>
                <span>Dark </span><span>Colors</span>
              </div>
              <!--------------------
              END - Color Scheme Toggler
              -------------------->
              @endif
</div>
