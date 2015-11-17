{include file='../layout/header.tpl'}
    <div id="main" class="content" role="main">
        <section class="main">
            <ul>
                <li{if $sNameSpies == 'pizza' } class="active" {/if}><a href="menu-pizza.html"><img src="img/menu/pizza.png">Pizza</a></li>
                <li{if $sNameSpies == 'salat' } class="active" {/if}><a href="menu-salat.html"><img src="img/menu/salat.png">Salat</a></li>
                <li{if $sNameSpies == 'nudeln' } class="active" {/if}><a href="menu-nudeln.html"><img src="img/menu/nudel.png">Nudel</a></li>
                <li{if $sNameSpies == 'antipasti' } class="active" {/if}><a href="menu-antipasti.html"><img src="img/menu/antipasti.png">Antipasti</a></li>
                <li{if $sNameSpies == 'fleisch' } class="active" {/if}><a href="menu-fleisch.html"><img src="img/menu/fleisch.png">Carne - Fleisch</a></li>
                <li{if $sNameSpies == 'fisch' } class="active" {/if}><a href="menu-fisch.html"><img src="img/menu/fisch.png">Pesce - Fisch</a></li>
                <li{if $sNameSpies == 'desser' } class="active" {/if}><a href="menu-desser.html"><img src="img/menu/dessert.png">Desser</a></li>
                <li{if $sNameSpies == 'getränke' } class="active" {/if}><a href="menu-getränke.html"><img src="img/menu/getrenke.png">Getränke</a></li>
            </ul>
        </section>
    </div>
       <div id="mainFooter">
        <section class="content">
            <ul class="showMenu">

                <li class="nameHeader">{$sNameSpies|@ucwords}</li>
                <li class="nameHeader">Preis</li>
            </ul>
            {foreach from=$oProductInfo item=oInfo key=key name=loop}
                <ul class="showMenu">
                    <li><span class="name">{$oInfo->name}</span>, {$oInfo->getDescription()}</li>
                    <li>{$oInfo->cost} €</li>
                </ul>
            {/foreach}
        </section>
    </div>
{include file='../layout/footer.tpl'}