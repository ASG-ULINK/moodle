<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package mod_game
 * @subpackage backup-moodle2
 * class backup_game_activity_task 
 * @author 
 * @version $Id: backup_game_activity_task.class.php,v 1.2 2012/07/25 11:16:04 bdaloukas Exp $
 * @package game
 **/
  
require_once($CFG->dirroot . '/mod/game/backup/moodle2/backup_game_stepslib.php'); // Because it exists (must)
require_once($CFG->dirroot . '/mod/game/backup/moodle2/backup_game_settingslib.php'); // Because it exists (optional)
 
/**
 * game backup task that provides all the settings and steps to perform one
 * complete backup of the activity
 */
class backup_game_activity_task extends backup_activity_task {

    /**
     * Define (add) particular settings this activity can have
     */
    protected function define_my_settings() {
        // No particular settings for this activity
    }

    /**
     * Define (add) particular steps this activity can have
     */
    protected function define_my_steps() {
        // Game only has one structure step
        $this->add_step(new backup_game_activity_structure_step('game_structure', 'game.xml'));        
    }
 
    /**
     * Code the transformations to perform in the activity in
     * order to get transportable (encoded) links
     */
    static public function encode_content_links($content) {
        global $CFG;
 
        $base = preg_quote($CFG->wwwroot,"/");
 
        // Link to the list of gamess
        $search="/(".$base."\/mod\/game\/index.php\?id\=)([0-9]+)/";
        $content= preg_replace($search, '$@GAMEINDEX*$2@$', $content);
 
        // Link to game view by moduleid
        $search="/(".$base."\/mod\/game\/view.php\?id\=)([0-9]+)/";
        $content= preg_replace($search, '$@GAMEVIEWBYID*$2@$', $content);
 
        return $content;
    }
}