<?php

$word = new COM("Word.Application");
$word->Visible = true;
$word->Documents->Add();
$word->Selection->TypeText("Hi!I'm a student at a ICT COLLEGE OF VOCATIONAL STUDIES in Belgrade.\n
                        Big fan of books, games, languages, comics, photos, sports and many things more\n
                        This is a project for our PHP class!\n
                        No images are for my own benefits! They are purely just for practicing of making a PHP website \n
                        For any questions you can @ me at: danilo.zdravkovic.227.16@ict.edu.rs");
$word->Documents[1]->SaveAs("aboutExported.doc");
