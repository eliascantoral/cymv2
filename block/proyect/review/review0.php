<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$section = "";
$feedback = get_feedback($proyectid, $step, $section);
//print_array($feedback);
?>
<div class="alert alert-warning" role="alert">
    <form class="form_review"> 
      <div class="form-group group-comment">
        <label class="col-sm-2 control-label">Comentario</label>
        <div class="col-sm-10">
            <textarea class="form-control comment" placeholder="Comentario"><?php echo $feedback!==false?$feedback[1]:""?></textarea>
        </div>
      </div>
      <div class="form-group group-rating hidden">
          <label class="col-sm-2 control-label">Punteo</label>
           <div class="br-wrapper-f col-sm-10">
               <select class="rating" id="rating_<?php echo $step."_".$section;?>" name="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                </select>
           </div>
      </div>        
      <div class="form-group group-refered">
          <label class="col-sm-2 control-label">Recomendar</label>
           <div class="col-sm-10">
               <input type="checkbox" class="refered" <?php echo $feedback[2]=="1"?'checked=""':'';?>>
           </div>
      </div>
      <div class="form-group form-group">
        <input type="hidden" class="step_id" value="<?php echo $step;?>">
        <input type="hidden" class="section_id" value="<?php echo $section;?>">
        <button type="submit" class="btn btn-default">Guardar</button>
      </div>
        <div class="alert alert-success message" id="messagefeedbackok_<?php echo $step."_".$section;?>" role="alert"></div>
        <div class="alert alert-danger message" id="messagefeedbacknok_<?php echo $step."_".$section;?>" role="alert"></div>
    </form>
</div>
