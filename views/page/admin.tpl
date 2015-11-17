{include file='../layout/header.tpl'}
    <div id="main" class="content" role="main">
		
		{if $error === 'type'}
			<h1>Wrong type of file</h1>
		{elseif $error === 'file'}
			<h1>Wrong or empty file</h1>
		{elseif $error}
			<h1>Success! But we have errors. Check the log file.</h1>
		{else}
			<h1>Success!</h1>
		{/if}
		<form action="index.php?page=importFile&admin=true" method="post" enctype="multipart/form-data">
			<label>Select file to import</label>
			<input type="file" name="importedFile" />
			
			<input type="submit" name="submit" value="Import now!" />
		</form>
    </div>
    <div id="mainFooter">
        <section class="content menu menuEdit">
            <h2>Produkte</h2>
            <ul class="showMenu">
                <li class="nameHeader">Name</li>
                <li class="nameHeader">Kategorien</li>
                <li class="nameHeader">Preis</li>
            </ul>
            {foreach from=$oProductInfo item=oInfo key=key name=loop}
                <ul class="showMenu">
                    <li><span class="name">{$oInfo->name}</span>, {$oInfo->getDescription()}</li>
                    <li><b>{$oInfo->catname}</b></li>
                    <li>{$oInfo->cost} €</li>
                </ul>
            {/foreach}
        </section>
    </div>
{include file='../layout/footer.tpl'}