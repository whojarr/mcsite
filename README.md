# mcsite
Minecraft website using open apis and transferred config files from various spigot plugins

## Apache Setup
copy the file etc/http/conf.d/mcsite.conf to /etc/httpd/conf.d/mcsite.conf
and update the ports and aliases to suite

## Folder Permissions
```bash
sudo chown apache html/images/admin_images
sudo chown apache html/images/player_images
```
