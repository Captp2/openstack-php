# ovh-swift
Allow basic operations with OVH Swift Object Storage

# Prerequisites

Environment variable giving the '.env' path, using the key 'ENV_PATH'

# Env example and explainations

```
SWIFT_USERNAME=
SWIFT_PASSWORD=
SWIFT_PROJECT_ID=
SWIFT_DOMAIN=default
SWIFT_REGION=
SWIFT_PROTOCOL=swift
MAX_FILE_SIZE=262144000
```

### OVH Examples

SWIFT_USERNAME : S3 User with 'ObjectStore operator' role at least.

SWIFT_PASSWORD : Password generated when creating user. Password can ben regenerated.

*Note that those are also used to access the OpenStack API GUI*

SWIFT_PROJECT_ID : Found in OpenStack API GUI under the "Projects" tab.
SWIFT_DOMAIN : Unsure. Appears to always be 'default'. Is 'default' bu default.
SWIFT_REGION : Region where your object storage is located
SWIFT_PROTOCOL : For now, only swift is supported.
MAX_FILE_SIZE : Defaults to OpenStack limitation.
