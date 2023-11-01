# ovh-swift
Allow basic operations with OVH Swift Object Storage

# Prerequisites

Environment variable giving the '.env' path, using the key 'ENV_PATH'

# Env example and explainations

```
OVH_USERNAME=
OVH_PASSWORD=
OVH_PROJECT_ID=
OVH_DOMAIN=default
OVH_REGION=
OVH_PROTOCOL=swift
MAX_FILE_SIZE=262144000
```

### OVH Examples

OVH_USERNAME : S3 User with 'ObjectStore operator' role at least.

OVH_PASSWORD : Password generated when creating user. Password can ben regenerated.

*Note that those are also used to access the OpenStack API GUI*

OVH_PROJECT_ID : Found in OpenStack API GUI under the "Projects" tab.
OVH_DOMAIN : Unsure. Appears to always be 'default'. Is 'default' bu default.
OVH_REGION : Region where your object storage is located
OVH_PROTOCOL : For now, only swift is supported.
MAX_FILE_SIZE : Defaults to OpenStack limitation.
