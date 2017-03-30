<?php
//v1.09.15
?>
<table class="optiontable wbridge" cellpadding="2" cellspacing="2">

    <?php if ($controlpanelOptions) {
        foreach ($controlpanelOptions as $value) {

            if ($value['type'] == "text" || $value['type'] == "password") {
                ?>
                <tr>
                    <td colspan="2">
                        <div class="alert info small">
                            <?php echo $value['desc']; ?>
                        </div>
                    </td>
                </tr>
                <tr align="left">
                    <th scope="row" class="wb_lbl"><?php echo $value['name']; ?></th>
                    <td><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
                               type="<?php echo $value['type']; ?>"
                               value="<?php if (get_option($value['id']) != "") {
                                   echo get_option($value['id']);
                               } else {
                                   echo isset($value['std']) ? $value['std'] : '';
                               } ?>"
                               size="40"
                               class="ipt"
                            /></td>
                </tr>

            <?php } elseif ($value['type'] == "info") { ?>

                <tr>
                    <td colspan="2">
                        <div class="alert info small">
                            <?php echo $value['desc']; ?>
                        </div>
                    </td>
                </tr>
                <tr align="left">
                    <th scope="row" class="wb_lbl"><?php echo $value['name']; ?></th>
                </tr>

            <?php } elseif ($value['type'] == "checkbox") { ?>

                <tr>
                    <td colspan="2">
                        <div class="alert info small">
                            <?php echo $value['desc']; ?>
                        </div>
                    </td>
                </tr>
                <tr align="left">
                    <th scope="row" class="wb_lbl"><?php echo $value['name']; ?></th>
                    <td><input class="ipt" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
                               type="checkbox"
                               value="checked"
                            <?php if (get_option($value['id']) != "") {
                                echo " checked";
                            } ?>
                            /></td>

                </tr>

            <?php } elseif ($value['type'] == "textarea") { ?>
                <tr>
                    <td colspan="2">
                        <div class="alert info small">
                            <?php echo $value['desc']; ?>
                        </div>
                    </td>
                </tr>
                <tr align="left">
                    <th scope="row" class="wb_lbl" colspan="2"><?php echo $value['name']; ?></th>
                </tr>
                <tr align="left">
                    <td colspan="2" align="center"><textarea class="ipt" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="50"
                                  rows="8"/><?php if (get_option($value['id']) != "") {
                            echo stripslashes(get_option($value['id']));
                        } else {
                            echo isset($value['std']) ? $value['std'] : '';
                        } ?></textarea></td>

                </tr>
            <?php } elseif ($value['type'] == "select") { ?>

                <tr>
                    <td colspan="2">
                        <div class="alert info small">
                            <?php echo $value['desc']; ?>
                        </div>
                    </td>
                </tr>
                <tr align="left">
                    <th scope="top" class="wb_lbl"><?php echo $value['name']; ?></th>
                    <td><select class="ipt" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                            <?php foreach ($value['options'] as $option) { ?>
                                <option <?php if (get_option($value['id']) == $option) {
                                    echo ' selected="selected"';
                                } ?>><?php echo $option; ?></option>
                            <?php } ?>
                        </select></td>
                </tr>

            <?php } elseif ($value['type'] == "selectwithkey") { ?>

                <tr>
                    <td colspan="2">
                        <div class="alert info small">
                            <?php echo $value['desc']; ?>
                        </div>
                    </td>
                </tr>
                <tr align="left">
                    <th scope="top" class="wb_lbl"><?php echo $value['name']; ?></th>
                    <td><select class="ipt" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                            <?php foreach ($value['options'] as $key => $option) { ?>
                                <option value="<?php echo $key; ?>"
                                    <?php
                                    if (get_option($value['id']) == $key) {
                                        echo ' selected="selected"';
                                    } elseif (!get_option($value['id']) && isset($value['std']) && $value['std'] == $key) {
                                        echo ' selected="selected"';
                                    }
                                    ?>
                                    ><?php echo $option; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

            <?php } elseif ($value['type'] == "heading") { ?>

                <tr>
                    <td colspan="2">
                        <div class="alert info small">
                            <?php echo $value['desc']; ?>
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <td colspan="2" style="text-align: left;">
                        <h2><?php echo $value['name']; ?></h2>
                    </td>
                </tr>

            <?php
            }
        } //end foreach
    }
    ?>
</table>