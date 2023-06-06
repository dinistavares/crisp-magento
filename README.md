# Crisp Module for Magento

A module to add [Crisp](https://crisp.chat) to your store.

### Installation

```bash
# Update your compose.json file
composer require crisp/chatbox-and-helpdesk:1.0.0

# Enable the Crisp module:
bin/magento module:enable Crisp_Crisp

# Register the extension and update the database schema & data
bin/magento setup:upgrade

# Generate the new code
bin/magento setup:di:compile

# Deploy static files
bin/magento setup:static-content:deploy

# Clean the cache
bin/magento cache:clean
```
