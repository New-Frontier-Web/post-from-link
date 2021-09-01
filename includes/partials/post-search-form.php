<h2 class="status-message success-message">Post added <i class="far fa-smile"></i></h2>
<h2 class="status-message fail-message">There was a problem <i class="far fa-frown"></i></h2>

<form action="" id="post-search-form">
    <div class="post-search-form-inner">

        <label for="post-from-link" id="pfl-label" style="text-transform: uppercase;font-weight: 600">
            <span class="text-blue" style="border-bottom: 5px solid #DC3F32">Post From Link</span>
        </label>
        <input type="text" name="post-from-link" id="pfl-link" placeholder="Enter your link..." autocomplete="off">
        <button type="submit" id="pfl-submit">
            <i class="fad fa-search"></i>
            <img src="<?php echo PFL_URL ?>/assets/images/search-loading.gif" id="loading-search-gif" alt="">
        </button>

    </div>
</form>

<div id="ret-container">

    <span>
        <div id="ret-image" style="width: 150px; height: 120px;background-size: cover;background-position: center;">
            <i class="fas fa-edit"></i>
        </div>
    </span>
    <div>
        <div style="width: 100%;">
            <span id="ret-title" contenteditable="true">Post Title</span>
        </div>
        <div style="width: 100%;">
            <span id="ret-description" contenteditable="true">Post Description</span>
        </div>

        <select name="" id="ret-category">
            <?php 
            
                foreach(get_categories(array('hide_empty' => 0)) as $category) { ?>
                    <option value="<?php echo $category->cat_ID ?>"><?php echo $category->name ?></option>
                <?php }
            
            ?>
        </select>
    </div>

    <div class="publish-container">

    </div>

</div>
<div id="publish-container">
    <div class="pfl-publish">
        PUBLISH <i class="fad fa-check"></i>
    </div>
    <div class="pfl-clear">
        CLEAR <i class="fad fa-times"></i>
    </div>
</div>