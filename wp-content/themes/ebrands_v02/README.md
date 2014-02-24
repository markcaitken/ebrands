# Theme: Camphin Boston
Git: #!# Final URL goes here!

## Folder Structure

###/assets

* **What:** All the of the scripts, stylesheets, images and fonts used in building the theme.
* **Why:** A single top level folder is cleaner, I guess :)

###/submodules

* **What:** Everything we clone from git (as submodules).
* **Why:** To ensure consistency, minimise potential for merge mess and to keep our own repo nice and lean.
* **Note:** Any files required from this sub-directory should be symlinked - not copied - to the prefered location with: `ln -s /path/to/file /path/to/symlink`
Example (from directory): `ln -s ../../../../submodules/less.js/dist/less-1.3.3.min.js less-1.3.3.min.js`

###/views

* **What:** All of our template includes
* **Why:** Again, keeps the root level clean and consistent. Also an attempt to seperate template/functionality markup.