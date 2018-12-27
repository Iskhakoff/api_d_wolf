<?
    $dictionaries = get_dictionaries();
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

    if(count($_POST)>0) {
        $response = manage_word($_POST);

        if($response['code'] == 200) {
            echo "<h4>managed</h4>";
        } else {
            echo "<h4>{$response['message']}</h4>";
        }
    }

    if(isset($_GET['wid'])) {
        $word = get_word_data($_GET['wid'])[0];
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <form action="<?=$_SERVER['PHP_SELF']?>?<?=$url?>" method="post">
                <? if(isset($_GET['wid'])): ?>
                    <input type="hidden" name="id" value="<?=$_GET['wid']?>">
                <? endif; ?>
                <div class="form-group">
                    <label for="word_name">word</label>
                    <input type="text" name="name" id="word_name" class="form-control" required value="<?=$word['name']??null?>">
                </div>
                <div class="form-group">
                    <label for="word_translate">translate</label>
                    <input type="text" name="translate" id="word_translate" class="form-control" required value="<?=$word['translate']??null?>">
                </div>
                <div class="form-group">
                    <label for="word_type">dictionary</label>
                    <select name="type_id" class="form-control" id="word_type">
                        <? foreach ($dictionaries as $dictionary): ?>
                            <? $selected = isset($word) ? ($word['type_id'] == $dictionary['id'] ? 'selected' : '') : '' ?>
                                <option value="<?=$dictionary['id']?>" <?=$selected?>><?=$dictionary['name']?></option>
                        <? endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="save" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
    </div>
</div>