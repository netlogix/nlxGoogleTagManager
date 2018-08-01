#!/usr/bin/env bash

sed -i "s~[\"]shopware/shopware[\"]: [\"]^5.2[\"]~\"shopware/shopware\": \"${SHOPWARE_VERSION}\"~g" composer.json
