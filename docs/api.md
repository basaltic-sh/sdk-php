# PHP service methods

Generated API reference. Bodies and filters use wire field names.
JSON results are immutable `Result` objects with array access. List methods return `Page`;
`All` methods lazily yield items. Binary responses are PSR-7 responses; close their bodies.

## Audit

`getAuditLogByReference(...)` resolves an ID, CRN, or scoped name.

### `audit()->getAuditLog()`

Get audit log entry

`GET /v1/audit-logs/{log_id}` → `Result`

Path arguments, in order: `logId`.

### `audit()->listAuditLogs()`

List audit logs

`GET /v1/audit-logs` → `Page`

Query fields:

- `crn` (string): Exact audit event CRN (crn:audit:::log/UUID). Foreign or mismatched identities yield an empty page. This selects the event itself, independently of resource and actor snapshots.
- `actor` (string): Filter by a canonical UUID or an exact event-time actor CRN, including Workspace users, account IAM identities, and retained historical CRNs. Matches identities stored with events in the current organization, including deleted actors. Bare names and wildcard CRNs are unsupported. Events without a stored CRN remain searchable by UUID.
- `actor_type` (string): Filter by actor type
- `action` (string): Filter by action (exact match or prefix with wildcard, e.g., "iam.*")
- `resource_type` (string): Filter by resource type
- `resource` (string): Filter by a canonical UUID or an event-time resource CRN, without looking up a live resource. A CRN matches exactly and also matches descendants at a literal `/` boundary: `crn:network:region:account:vpc/prod` matches stored `crn:network:region:account:vpc/prod/subnet/private`. Account and region are matched exactly within the current organization. Percent and underscore characters are literal, not wildcards. Bare names and wildcard CRNs are unsupported. Events without a stored CRN remain searchable by UUID. The resource_type filter applies independently, including to descendant events.
- `status` (string): Filter by status
- `ip_address` (string): Filter by IP address
- `from` (string): Filter logs from this timestamp (inclusive)
- `to` (string): Filter logs until this timestamp (exclusive)
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

## Billing

### `billing()->getBillingProfile()`

Read the organization billing profile

`GET /v1/profile` → `Result`

### `billing()->getCurrentUsage()`

Get month-to-date usage total

`GET /v1/usage` → `Result`

### `billing()->getFiscalInvoiceXml()`

Download issued NFS-e XML

`GET /v1/fiscal-invoices/{document_id}/xml` → `ResponseInterface`

Path arguments, in order: `documentId`.

`getInvoiceByReference(...)` resolves an ID, CRN, or scoped name.

### `billing()->getInvoice()`

Get an invoice with its line items

`GET /v1/invoices/{invoice_id}` → `Result`

Path arguments, in order: `invoiceId`.

### `billing()->getInvoicePdf()`

Download an invoice as a PDF statement

`GET /v1/invoices/{invoice_id}/pdf` → `ResponseInterface`

Path arguments, in order: `invoiceId`.

### `billing()->listCredits()`

List credit grants

`GET /v1/credits` → `Page`

Query fields:

- `crn` (string): Exact organization-scoped credit CRN. Foreign or mismatched identities return an empty page.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.

### `billing()->listFiscalInvoices()`

List fiscal invoice issuance and delivery status

`GET /v1/fiscal-invoices` → `Page`

Query fields:

- `invoice` (string): Canonical billing invoice CRN.

### `billing()->listInvoices()`

List invoices

`GET /v1/invoices` → `Page`

Query fields:

- `crn` (string): Exact organization-scoped invoice CRN. Foreign or mismatched identities return an empty page.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.

### `billing()->listPayments()`

List invoice payments

`GET /v1/payments` → `Page`

Query fields:

- `crn` (string): Exact organization-scoped payment CRN. Foreign or mismatched identities return an empty page.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.

### `billing()->listPrices()`

List catalog prices

`GET /v1/prices` → `Page`

Query fields:

- `service` (string): Only SKUs billed by this service.
- `resource_type` (string): 
- `sku` (string): Exactly one SKU.
- `family` (string): Only SKUs whose `metadata.family` matches — how the managed products are separated from the general compute flavors.
- `at` (string): Read the catalog as of this instant instead of now, for showing a historical price. RFC3339.

### `billing()->listTransactions()`

List ledger transactions

`GET /v1/transactions` → `Page`

Query fields:

- `crn` (string): Exact organization-scoped transaction CRN. Foreign or mismatched identities return an empty page.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.

### `billing()->updateBillingProfile()`

Save organization billing details

`PUT /v1/profile` → `Result`

Body fields:

- `customer_type` (string): 
- `company_name` (string): Full legal name of the individual or company.
- `country` (string): ISO 3166-1 alpha-2 country code.
- `tax_id` (string): CPF for a Brazilian individual or CNPJ for a Brazilian company. Check digits are validated.
- `foreign_tax_id` (string): Foreign identifier; not validated as a Brazilian document.
- `no_tax_id_reason` (string): Required for a foreign recipient without a tax identifier.
- `email` (string): Billing email for fiscal invoice delivery. The onboarding form prefills this from the signed-in user's email.
- `phone` (string): 
- `street_name` (string): 
- `street_number` (string): 
- `complement` (string): 
- `neighborhood` (string): 
- `city` (string): 
- `municipality_code` (string): Seven-digit IBGE municipality code, required for a Brazilian recipient.
- `state` (string): Two-letter UF for Brazil; free-form state/province abroad.
- `postal_code` (string): Eight-digit CEP for Brazil; optional international postal code abroad.
- `ready` (boolean): 
- `missing_fields` (array): 

## Catalog

`getRegionByReference(...)` resolves an ID, CRN, or scoped name.

### `catalog()->getRegion()`

Get a region

`GET /v1/regions/{code}` → `Result`

Path arguments, in order: `code`.

### `catalog()->listRegions()`

List regions

`GET /v1/regions` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

## Certificate

### `certificate()->createCertificate()`

Create certificate

`POST /v1/certificates` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Unique per account. Surfaces in the CRN (`crn:certificate::<account>:certificate/<name>`), so it must be URL-safe — letters, digits, dot, dash, underscore. Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `domains` (array, required): Capped at 100 to stay inside the certificate authority's per-order limits.
- `key_algorithm` (string): 
- `source` (string): 
- `certificate_pem` (string): PEM-encoded leaf certificate. Required when source=uploaded.
- `chain_pem` (string): PEM-encoded intermediate chain (optional when source=uploaded).
- `private_key_pem` (string): PEM-encoded private key. Required when source=uploaded.
- `tags` (object): 

### `certificate()->deleteCertificate()`

Delete certificate

`DELETE /v1/certificates/{certificate_id}` → `void`

Path arguments, in order: `certificateId`.

`getCertificateByReference(...)` resolves an ID, CRN, or scoped name.

### `certificate()->getCertificate()`

Get certificate

`GET /v1/certificates/{certificate_id}` → `Result`

Path arguments, in order: `certificateId`.

### `certificate()->getCertificateMaterial()`

Fetch certificate material (leaf, chain, private key)

`GET /v1/certificates/{certificate_id}/material` → `Result`

Path arguments, in order: `certificateId`.

### `certificate()->listCertificates()`

List certificates

`GET /v1/certificates` → `Page`

Query fields:

- `name` (string): Exact, case-sensitive certificate name within the caller's account.
- `crn` (string): Exact certificate CRN. Foreign accounts or mismatched service, type or region return an empty page; malformed syntax returns 400. Combined conjunctively with name before pagination.
- `limit` (integer): 
- `marker` (string): Resume token — the last certificate id from the previous page.

### `certificate()->revokeCertificate()`

Revoke certificate

`POST /v1/certificates/{certificate_id}/revoke` → `Result`

Path arguments, in order: `certificateId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

## Compute

### `compute()->attachInstanceNIC()`

Attach an existing NIC to an instance

`POST /v1/instances/{instance_id}/nics` → `Result`

Path arguments, in order: `instanceId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `interface` (string, required): Existing standalone interface UUID or complete VPC/subnet/interface CRN. Bare names lack the subnet parent and are rejected. It keeps its address, MAC, and security groups; detach returns it to standalone instead of destroying it.

### `compute()->attachInstancePoolFloatingIp()`

Give the pool a shared public address

`POST /v1/instance-pools/{pool_id}/floating-ips` → `Result`

Path arguments, in order: `poolId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `floating_ip` (string, required): An account-scoped floating IP UUID or CRN (bare names are not accepted), currently attached to nothing. This binds it to the pool; it does not allocate one.

### `compute()->attachInstanceVolume()`

Attach a data volume to an instance

`POST /v1/instances/{instance_id}/volumes` → `Result`

Path arguments, in order: `instanceId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `volume` (string, required): Account-scoped volume reference (UUID, CRN or exact name).
- `device` (string): Optional device-name override; auto-picks the next free slot (vdb/vdc/…) when omitted.
- `mount_path` (string): When set, the in-guest agent formats the disk (only if blank) and mounts it at this path. Empty attaches the block device only.
- `fstype` (string): Filesystem the in-guest agent formats the disk with, and only when `mount_path` is set and the disk is blank. Rejected with 400 if it is neither value.

### `compute()->createImage()`

Import an image from an object URL

`POST /v1/images` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Immutable image name (e.g. debian-13) whose current-version pointer can move; the new image becomes its current version. Names are shared across a tag's builds — one build is identified by owner, name, architecture and version. Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `source_url` (string, required): Presigned https GET URL to the disk in an object store you control. Fetched once by the import worker (which rejects private/link-local targets). The worker detects qcow2, raw, vmdk, vhd, vhdx or vdi and converts it to raw storage. Unreadable or unsupported sources and images declaring backing files fail asynchronously with status error and an active conversion fault. Not retained after import.
- `description` (string): 
- `os` (string): Operating system distribution. Use linux for another or generic Linux distribution; os_version specifies the release separately.
- `os_version` (string): 
- `architecture` (string): CPU architecture of the source image. Only amd64 (x86-64) is supported.
- `version` (string): Identifies this build within `name`, and must be unique there — re-publishing a version that a tag already carries is a 409. Omit it and the server stamps a UTC timestamp, so every build is addressable as `name:version` whether or not you labelled it.
- `current` (boolean): Make this the current version for its (name, architecture) once active.
- `eol_date` (string): The day this release stops receiving free security updates. Omit it and the image inherits the date the name's current version carries, so re-publishing a tag can't quietly stop tracking its release.
- `min_disk_gb` (integer): 
- `min_ram_mb` (integer): 
- `tags` (object): 
- `attributes` (object): 

### `compute()->createInstance()`

Create instance

`POST /v1/instances` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `flavor` (string, required): Regional flavor reference (UUID, CRN or exact name)
- `architecture` (string): Architecture for image names and name:version tags (default amd64); a CRN pins its own architecture and version.
- `image` (string): Image to clone the boot disk from. Required unless volumes contains an existing boot volume; cannot be combined with an existing boot volume. Four forms are accepted: a complete image/name/architecture/arch/version/version CRN; an image id; `name:version`, which pins one build and is how you opt out of the tag moving under you; or a bare `name`, which follows the tag to whichever build is current when the instance is created. Names prefer a usable caller-owned build over a tagged platform catalog build for the requested architecture (default amd64). A CRN pins owner, name, architecture and version. Resolution never retries another reference kind; responses and stored templates retain the resolved image UUID.
- `networks` (array, required): Interfaces to attach, at least one. index 0 is the primary NIC. Required because an instance with no interface boots with no network at all, and nothing inside it can add one afterwards.
- `volumes` (array): New or existing disks bound with the instance, the boot disk included — mark it with `boot: true`. At most one entry may. Omit the boot entry to take the image's minimum size and the region's default tier.
- `metadata` (object): 
- `tags` (object): 
- `user_data` (string): Base64-encoded user data (cloud-init)
- `iam_role` (string): Attach an IAM role from the same account by UUID, CRN or exact name. The role's trust policy must permit `crn:compute:*:*:instance/*` (or the specific instance CRN). The instance's IMDS endpoint (169.254.169.254) mints short-lived STS credentials for this role from inside the VM.

### `compute()->createInstancePool()`

Create an instance pool

`POST /v1/instance-pools` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): Labels on the pool resource, for IAM conditions (`basalt:RequestTag/<key>` here, `basalt:ResourceTag/<key>` on later operations) and cost attribution. They are not propagated to the instances the pool launches; `template.tags` is that set. A pool field, sent beside `template`. Replica tags are only reachable through `template.tags`.
- `template` (object, required): The pool's launch config, in the shape a standalone instance create takes: same field names, same types, same meanings, so a client that can build an instance can build a pool of them without a second, narrower contract to learn. It belongs to the pool. There is no separate launch-template resource to create, version or share between pools. Networking is one ordered `networks` list, index 0 being the primary NIC. `ip_address` and `mac` are part of that shared NIC shape but are refused here: every replica launches from this one template, so a fixed address would have the second replica ask for one the first already holds.
- `desired_count` (integer): 
- `min_count` (integer): 
- `max_count` (integer): A value of 0 means the pool holds no members until max_count is raised.

### `compute()->createSerialConsoleTicket()`

Mint a ticket for the serial console

`POST /v1/instances/{instance_id}/console/ticket` → `Result`

Path arguments, in order: `instanceId`.

### `compute()->deleteImage()`

Delete an unused image

`DELETE /v1/images/{image_id}` → `Result`

Path arguments, in order: `imageId`.

### `compute()->deleteInstance()`

Delete instance

`DELETE /v1/instances/{instance_id}` → `void`

Path arguments, in order: `instanceId`.

### `compute()->deleteInstancePool()`

Delete an instance pool

`DELETE /v1/instance-pools/{pool_id}` → `void`

Path arguments, in order: `poolId`.

### `compute()->detachInstanceNIC()`

Detach a NIC from a running instance

`DELETE /v1/instances/{instance_id}/nics/{interface_id}` → `void`

Path arguments, in order: `instanceId`, `interfaceId`.

### `compute()->detachInstancePoolFloatingIp()`

Take a shared address off the pool

`DELETE /v1/instance-pools/{pool_id}/floating-ips/{floating_ip_id}` → `void`

Path arguments, in order: `poolId`, `floatingIpId`.

### `compute()->detachInstanceVolume()`

Detach a data volume from an instance

`DELETE /v1/instances/{instance_id}/volumes/{volume_id}` → `void`

Path arguments, in order: `instanceId`, `volumeId`.

### `compute()->getConsoleOutput()`

Get the instance's serial console output

`GET /v1/instances/{instance_id}/console/output` → `Result`

Path arguments, in order: `instanceId`.

Query fields:

- `max_bytes` (integer): Return at most this many bytes from the END of the transcript. A ceiling you may lower, not raise: values above the 65536-byte maximum are clamped to it.

### `compute()->getConsoleScreenshot()`

Capture the instance's display

`GET /v1/instances/{instance_id}/console/screenshot` → `ResponseInterface`

Path arguments, in order: `instanceId`.

`getFlavorByReference(...)` resolves an ID, CRN, or scoped name.

### `compute()->getFlavor()`

Get flavor

`GET /v1/flavors/{flavor_id}` → `Result`

Path arguments, in order: `flavorId`.

`getImageByReference(...)` resolves an ID, CRN, or scoped name.

### `compute()->getImage()`

Get an image

`GET /v1/images/{image_id}` → `Result`

Path arguments, in order: `imageId`.

`getInstanceByReference(...)` resolves an ID, CRN, or scoped name.

### `compute()->getInstance()`

Get instance

`GET /v1/instances/{instance_id}` → `Result`

Path arguments, in order: `instanceId`.

`getInstancePoolByReference(...)` resolves an ID, CRN, or scoped name.

### `compute()->getInstancePool()`

Get an instance pool

`GET /v1/instance-pools/{pool_id}` → `Result`

Path arguments, in order: `poolId`.

### `compute()->listFlavors()`

List flavors

`GET /v1/flavors` → `Page`

Query fields:

- `name` (string): Exact, case-sensitive name. Empty values match no named resources. Instance NIC lists match interface names within the instance bindings; multiple interfaces with the same name may match. Floating IPs have no name identity and return an empty list for this filter.
- `crn` (string): Exact resource CRN, intersected with all other filters before pagination. A foreign or mismatched CRN returns an empty page; malformed or empty CRNs return 400. Nested attachment lists filter the represented resource, not the binding.
- `family` (string): Filter by product family. Load-balancer and database create flows should list their own family; regular instances use "general".

### `compute()->listImageCatalog()`

List the launch image catalog

`GET /v1/image-catalog` → `Page`

Query fields:

- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.
- `name` (string): Exact image name.
- `os` (string): 
- `architecture` (string): 

### `compute()->listImages()`

List images

`GET /v1/images` → `Page`

Query fields:

- `crn` (string): Exact resource CRN, intersected with all other filters before pagination. A foreign or mismatched CRN returns an empty page; malformed or empty CRNs return 400. Nested attachment lists filter the represented resource, not the binding.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.
- `os` (string): 
- `architecture` (string): 
- `name` (string): Exact, case-sensitive name match; an empty value matches no named resource.
- `status` (string): 
- `all_versions` (boolean): Include builds a newer version has superseded. Off by default, when each tag contributes only the build worth launching.

### `compute()->listInstanceNICs()`

List the instance's network interfaces

`GET /v1/instances/{instance_id}/nics` → `Page`

Path arguments, in order: `instanceId`.

Query fields:

- `name` (string): Exact, case-sensitive name. Empty values match no named resources. Instance NIC lists match interface names within the instance bindings; multiple interfaces with the same name may match. Floating IPs have no name identity and return an empty list for this filter.
- `crn` (string): Exact resource CRN, intersected with all other filters before pagination. A foreign or mismatched CRN returns an empty page; malformed or empty CRNs return 400. Nested attachment lists filter the represented resource, not the binding.

### `compute()->listInstancePoolFloatingIps()`

List the pool's shared public addresses

`GET /v1/instance-pools/{pool_id}/floating-ips` → `Page`

Path arguments, in order: `poolId`.

Query fields:

- `name` (string): Exact resource name. This resource has no name, so a supplied name returns an empty result.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `compute()->listInstancePools()`

List instance pools

`GET /v1/instance-pools` → `Page`

Query fields:

- `name` (string): Exact, case-sensitive name. Empty values match no named resources. Instance NIC lists match interface names within the instance bindings; multiple interfaces with the same name may match. Floating IPs have no name identity and return an empty list for this filter.
- `crn` (string): Exact resource CRN, intersected with all other filters before pagination. A foreign or mismatched CRN returns an empty page; malformed or empty CRNs return 400. Nested attachment lists filter the represented resource, not the binding.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `compute()->listInstanceVolumes()`

List the instance's attached volumes

`GET /v1/instances/{instance_id}/volumes` → `Page`

Path arguments, in order: `instanceId`.

Query fields:

- `name` (string): Exact, case-sensitive name. Empty values match no named resources. Instance NIC lists match interface names within the instance bindings; multiple interfaces with the same name may match. Floating IPs have no name identity and return an empty list for this filter.
- `crn` (string): Exact resource CRN, intersected with all other filters before pagination. A foreign or mismatched CRN returns an empty page; malformed or empty CRNs return 400. Nested attachment lists filter the represented resource, not the binding.

### `compute()->listInstances()`

List instances

`GET /v1/instances` → `Page`

Query fields:

- `crn` (string): Exact resource CRN, intersected with all other filters before pagination. A foreign or mismatched CRN returns an empty page; malformed or empty CRNs return 400. Nested attachment lists filter the represented resource, not the binding.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.
- `name` (string): Exact, case-sensitive name. Empty values match no named resources. Instance NIC lists match interface names within the instance bindings; multiple interfaces with the same name may match. Floating IPs have no name identity and return an empty list for this filter.
- `current_state` (string): Filter by where the instances actually are.
- `flavor` (string): Filter by regional flavor reference (UUID, CRN or exact name).
- `image` (string): Filter by image reference (UUID, CRN or name; images also accept name:version).

### `compute()->listPoolInstances()`

List a pool's instances

`GET /v1/instance-pools/{pool_id}/instances` → `Page`

Path arguments, in order: `poolId`.

Query fields:

- `crn` (string): Exact resource CRN, intersected with all other filters before pagination. A foreign or mismatched CRN returns an empty page; malformed or empty CRNs return 400. Nested attachment lists filter the represented resource, not the binding.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.
- `name` (string): Exact, case-sensitive name. Empty values match no named resources. Instance NIC lists match interface names within the instance bindings; multiple interfaces with the same name may match. Floating IPs have no name identity and return an empty list for this filter.
- `current_state` (string): Filter by where the instances actually are.
- `flavor` (string): Filter by regional flavor reference (UUID, CRN or exact name).
- `image` (string): Filter by image reference (UUID, CRN or name; images also accept name:version).

### `compute()->rebootInstance()`

Reboot instance

`POST /v1/instances/{instance_id}/reboot` → `void`

Path arguments, in order: `instanceId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `hard` (boolean): Force a power cycle (destroy + start, equivalent to a reset button) instead of the default ACPI graceful reboot the guest can act on.

### `compute()->refreshInstancePool()`

Roll every member onto the pool's current launch template

`POST /v1/instance-pools/{pool_id}/refresh` → `Result`

Path arguments, in order: `poolId`.

### `compute()->reinstallInstance()`

Reinstall instance

`POST /v1/instances/{instance_id}/reinstall` → `void`

Path arguments, in order: `instanceId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `image` (string): Replacement image reference (UUID, architecture-qualified CRN, name or name:version). Omit to reinstall from the instance's current image.
- `size_gb` (integer): Replacement boot disk size; omitted = the image's min_disk_gb. Must be within the volume size range (1..16384) and at least the image's min_disk_gb.
- `volume_type` (string): Replacement boot disk tier; omitted = the region default.

### `compute()->resizeInstance()`

Resize instance

`POST /v1/instances/{instance_id}/resize` → `void`

Path arguments, in order: `instanceId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `flavor` (string, required): Regional flavor reference (UUID, CRN or exact name) to resize to.

### `compute()->startInstance()`

Start instance

`POST /v1/instances/{instance_id}/start` → `void`

Path arguments, in order: `instanceId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

### `compute()->startSerialConsole()`

Open an interactive serial console

`GET /v1/instances/{instance_id}/console/serial` → `RequestInterface`

Path arguments, in order: `instanceId`.

Query fields:

- `backlog_bytes` (integer): Replay this many bytes of already-written output before live output begins, so attaching to a quiet guest shows why it is quiet instead of an empty screen. 0 disables replay. Values above 65536 are clamped. The replay is the tail of the same recording `/console/output` serves; the live session is the guest's serial port. The two are separate sources, so the join is marked with a `\r\n--- live ---\r\n` line: everything before it is history, everything after it is happening now. A guest printing at the instant you connect may have a few bytes land on neither side of that line — a quiet guest, the case replay exists for, is replayed exactly.

### `compute()->stopInstance()`

Stop instance

`POST /v1/instances/{instance_id}/stop` → `void`

Path arguments, in order: `instanceId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

### `compute()->updateImage()`

Update an image's metadata

`PATCH /v1/images/{image_id}` → `Result`

Path arguments, in order: `imageId`.

Body fields:

- `description` (string): 
- `current` (boolean): Switch the resolve-by-name pointer for this image's name. true promotes this version to current (the switch / rollback action) and demotes whatever else was current for the same (name, architecture); false clears the pointer. Only active images can be made current.
- `eol_date` (string): Set the release's end-of-life date. An explicit null clears it; omitting the field leaves it unchanged. Clearing matters because the catalog withdraws platform images on this date — one recorded by mistake has to be removable.
- `tags` (object): 
- `attributes` (object): 

### `compute()->updateInstance()`

Update instance

`PATCH /v1/instances/{instance_id}` → `Result`

Path arguments, in order: `instanceId`.

Body fields:

- `iam_role` (string): Attach or replace the instance workload role using its ID, name, or CRN. Omit this field to keep the current role; send an empty string to detach it. Null is not accepted. Requires compute:UpdateInstance; attach/replace also require iam:PassRole and a role trust policy allowing this instance. Only running or stopped customer-managed instances with no operation in progress support role edits. Pool members use the pool launch template. New IMDS requests observe the committed association immediately. Previously issued credentials are not revoked and remain valid until expiry (up to one hour); in-flight requests may complete with their prior association.
- `description` (string): 
- `metadata` (object): 
- `tags` (object): 

### `compute()->updateInstancePool()`

Update an instance pool's description, size, tags or launch template

`PATCH /v1/instance-pools/{pool_id}` → `Result`

Path arguments, in order: `poolId`.

Body fields:

- `description` (string): Customer note on the pool. Omit to preserve it; send an empty string to clear it. Changes no instances, sizing or launch configuration.
- `tags` (object): REPLACES the pool's labels: the map you send becomes the whole set, an empty object clears them, and omitting the field leaves them alone. Replacement rather than a merge because a merge leaves no way to say a key should be removed. These label the pool, not its instances. To change what future replicas are tagged with, send `template.tags`.
- `desired_count` (integer): New target size, bounded by the resulting min_count/max_count and the hard platform cap of 100.
- `min_count` (integer): New lower bound; omitted desired_count rises to this bound if needed.
- `max_count` (integer): New upper bound; omitted desired_count falls to this bound if needed. A value of 0 means the pool holds no members until max_count is raised.
- `template` (object): Replaces the launch config WHOLESALE — the object you send is what the pool launches next, and anything you leave out is cleared rather than kept. Replacement rather than a deep merge so a shorter `networks` or `volumes` cannot be read as a truncation and silently drop an interface or a disk.

### `compute()->updateInstanceVolumeAttachment()`

Update a volume attachment's settings

`PATCH /v1/instances/{instance_id}/volumes/{volume_id}` → `void`

Path arguments, in order: `instanceId`, `volumeId`.

Body fields:

- `delete_on_termination` (boolean, required): 

## Dns

### `dns()->associateZoneVPC()`

Associate a VPC with a private zone

`POST /v1/zones/{zone_id}/vpc-associations` → `Result`

Path arguments, in order: `zoneId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `vpc` (string, required): Account-owned VPC UUID or network/vpc CRN to associate with this private zone. Bare names return 400 with "VPC references on DNS zones must be a UUID or a CRN, which carries the region". CRNs resolve in their named region; UUIDs search all regions enabled for DNS. Missing, foreign-account or unconfigured-region VPCs return 404. Incomplete UUID searches or duplicate regional UUID identities fail with a server error. The response contains the canonical VPC UUID.

### `dns()->createRecord()`

Create record

`POST /v1/zones/{zone_id}/records` → `Result`

Path arguments, in order: `zoneId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Record name (FQDN).
- `type` (string, required): Curated subset of supported DNS record types. SOA and DNSSEC-managed types (DNSKEY, DS, NSEC*, RRSIG, …) are managed by the platform and not creatable through the API. Every type here has a wire representation. ALIAS is not offered: it resolves only if the authoritative server flattens it to A/AAAA, and ours does not. Point a zone apex at a target with A/AAAA records carrying its addresses.
- `ttl` (integer): 
- `values` (array, required): 

### `dns()->createZone()`

Create zone

`POST /v1/zones` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Zone FQDN. Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): Free-form note stored with and returned on the zone.
- `visibility` (string): `private` restricts the zone to the VPCs named in `vpcs` and requires at least one; `public` (the default) rejects `vpcs` outright rather than ignoring them. Cannot be changed afterwards.
- `dnssec` (boolean): Sign the zone with DNSSEC. On unless you say otherwise, and almost every zone should leave it on. **Turn it off only if this domain is served by another DNS provider at the same time as us.** A signed zone puts our DS record at the parent, and that DS covers only the answers WE sign — so a validating resolver that happens to ask the other provider gets a signature it cannot verify and fails the lookup. Roughly half your queries, unpredictably, which is worse than either provider on its own. Unsigned is the only configuration that works for that setup today. Fixed at creation. Turning signing off later breaks the domain until the DS is withdrawn at the registrar and that withdrawal has propagated, which is a sequence this API cannot drive for you.
- `import_existing_records` (boolean): Read the domain's records from the nameservers that serve it TODAY and copy them into this zone, before you move the delegation here. Worth asking for when you are migrating a live domain. The delegation is the ownership proof, so the moment you point your registrar at this zone is the moment we start answering for it — and an empty zone answers with nothing, which takes the site and the mail down until you have retyped everything. Runs in the background; the zone is created immediately. Poll GET /v1/zones/{zone_id}/record-import for the outcome. Best effort, and the result says how good it was. A zone transfer is exhaustive and almost always refused; the fallback queries a list of common names and cannot find a record it did not think to ask for. Check `record_import.complete` before you switch your old provider off. Records you have already created are never overwritten, and records this platform manages itself — the SOA, the DNSSEC chain, the zone's nameservers — are never imported.
- `vpcs` (array): Account-owned VPC UUIDs or network/vpc CRNs the zone resolves in. Bare names are rejected with 400 because the request fixes no region. CRNs resolve in their named region; UUIDs search all regions enabled for DNS. Missing, foreign-account or unconfigured-region VPCs return 404. Incomplete UUID searches or duplicate regional UUID identities fail with a server error. References are deduplicated by UUID. Required when visibility=private, rejected when visibility=public. More can be associated later via POST /v1/zones/{zone_id}/vpc-associations.
- `tags` (object): 

### `dns()->deleteRecord()`

Delete record

`DELETE /v1/zones/{zone_id}/records/{record_id}` → `void`

Path arguments, in order: `zoneId`, `recordId`.

### `dns()->deleteZone()`

Delete zone

`DELETE /v1/zones/{zone_id}` → `void`

Path arguments, in order: `zoneId`.

### `dns()->deleteZoneRecordImport()`

Discard the record-import outcome

`DELETE /v1/zones/{zone_id}/record-import` → `void`

Path arguments, in order: `zoneId`.

### `dns()->dissociateZoneVPC()`

Dissociate a VPC from a private zone

`DELETE /v1/zones/{zone_id}/vpc-associations/{vpc_id}` → `void`

Path arguments, in order: `zoneId`, `vpcId`.

### `dns()->exportZoneFile()`

Export the zone as a zone file

`GET /v1/zones/{zone_id}/export` → `ResponseInterface`

Path arguments, in order: `zoneId`.

`getRecordByReference(...)` resolves an ID, CRN, or scoped name.

### `dns()->getRecord()`

Get record

`GET /v1/zones/{zone_id}/records/{record_id}` → `Result`

Path arguments, in order: `zoneId`, `recordId`.

`getZoneByReference(...)` resolves an ID, CRN, or scoped name.

### `dns()->getZone()`

Get zone

`GET /v1/zones/{zone_id}` → `Result`

Path arguments, in order: `zoneId`.

### `dns()->getZoneRecordImport()`

Get the record-import outcome

`GET /v1/zones/{zone_id}/record-import` → `Result`

Path arguments, in order: `zoneId`.

### `dns()->importZoneFile()`

Import a zone file

`POST /v1/zones/{zone_id}/import` → `Result`

Path arguments, in order: `zoneId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `zone_file` (string, required): The zone file, as text. `$ORIGIN`, `$TTL`, `$GENERATE`, relative names and parenthesised multi-line records are all honoured; `$INCLUDE` is refused, because the path it names would be read on our filesystem rather than yours.

### `dns()->listRecords()`

List records

`GET /v1/zones/{zone_id}/records` → `Page`

Path arguments, in order: `zoneId`.

Query fields:

- `type` (string): Exact record type to filter by (e.g. `A`, `MX`).
- `name` (string): Exact record name, lowercased with an optional trailing dot removed.
- `crn` (string): Exact nested record CRN. Foreign or mismatched CRNs return an empty page; combined with name before pagination.
- `include_managed` (boolean): Include the platform-stamped rows (SOA, apex NS, and the DNSSEC set) alongside your own. Off by default — they cannot be edited or deleted, and on a signed zone there are more of them than there are of yours.
- `limit` (integer): 
- `marker` (string): Resume token — the last record id from the previous page.

### `dns()->listZoneVPCAssociations()`

List VPC associations

`GET /v1/zones/{zone_id}/vpc-associations` → `Page`

Path arguments, in order: `zoneId`.

Query fields:

- `name` (string): Exact name of an associated VPC. An empty value matches nothing.
- `crn` (string): Exact associated VPC CRN in a region enabled for DNS. Name and CRN filters are conjunctive. Foreign or mismatched CRNs return an empty collection.

### `dns()->listZones()`

List zones

`GET /v1/zones` → `Page`

Query fields:

- `name` (string): Exact zone name, lowercased. Combined conjunctively with crn before pagination.
- `crn` (string): Exact dns/zone CRN with empty region and the caller's account. Malformed CRNs return 400; valid foreign or mismatched CRNs return an empty page.
- `limit` (integer): 
- `marker` (string): Resume token — the last zone id from the previous page.

### `dns()->updateRecord()`

Update record

`PATCH /v1/zones/{zone_id}/records/{record_id}` → `Result`

Path arguments, in order: `zoneId`, `recordId`.

Body fields:

- `ttl` (integer): 
- `values` (array): 

### `dns()->updateZone()`

Update zone

`PATCH /v1/zones/{zone_id}` → `Result`

Path arguments, in order: `zoneId`.

Body fields:

- `description` (string): Omit to preserve the description; send an empty string to clear it.
- `tags` (object): 

### `dns()->verifyZoneOwnership()`

Verify zone ownership

`POST /v1/zones/{zone_id}/verify-ownership` → `Result`

Path arguments, in order: `zoneId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

## Iam

### `iam()->assumeRole()`

Assume role

`POST /v1/assume-role` → `Result`

Body fields:

- `role` (string, required): Account role UUID, immutable name in the selected account, or crn:iam::<account-handle>:role/<name>. AssumeRole may use a qualified CRN to target another account in the same organization. The resulting session is bound to the target role account.
- `duration_seconds` (integer): Credential validity duration (15 min to 12 hours)
- `policy` (object): An inline policy that scopes down the credentials being minted. It grants nothing on its own: every request made with the resulting credentials must be allowed by the assumed role's effective policies *and* by this document, so it can only narrow the permissions of the assumed role. The document is validated on the way in and stored with the session — an invalid one fails the call with `INVALID_INPUT` rather than being ignored. Statements take the same shape as in a managed policy but carry no `conditions`; a session policy fences on actions and resources only.

### `iam()->assumeRoleWithWebIdentity()`

Assume role with web identity

`POST /v1/assume-role-with-web-identity` → `Result`

Body fields:

- `web_identity_token` (string, required): The identity token to exchange, as a signed JWT. It is verified before any role is read: the signature must chain to a key the trusted provider publishes, the audience must be the one this platform was configured to accept, and `exp` must be in the future.
- `role` (string, required): Account role UUID, immutable name in the selected account, or crn:iam::<account-handle>:role/<name>. AssumeRole may use a qualified CRN to target another account in the same organization. The resulting session is bound to the target role account.
- `account` (string, required): Account UUID, immutable handle, or a Workspace account CRN (crn:workspace:::account/<uuid>). The account establishes the owning organization for federation and must match the target role account.
- `session_name` (string): A label recorded on the session and in the audit trail. Defaults to the token's `sub` claim, so an unnamed session still records which identity it came from.
- `duration_seconds` (integer): Credential validity duration (15 min to 12 hours). A value above the role's own `max_session_duration` is rejected rather than clamped.

### `iam()->attachRolePolicy()`

Attach policy to role

`POST /v1/roles/{role_id}/policies` → `void`

Path arguments, in order: `roleId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `policy` (string, required): Account policy UUID, immutable name in the selected account, or account-qualified IAM CRN. Shared system policies use crn:iam:::policy/<name>. CRNs select one namespace without fallback.

### `iam()->attachServiceAccountPolicy()`

Attach policy to service account

`POST /v1/service-accounts/{service_account_id}/policies` → `void`

Path arguments, in order: `serviceAccountId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `policy` (string, required): Account policy UUID, immutable name in the selected account, or account-qualified IAM CRN. Shared system policies use crn:iam:::policy/<name>. CRNs select one namespace without fallback.

### `iam()->authorizeOAuthClient()`

Approve a CLI login and issue an authorization code

`POST /v1/oauth/authorize` → `Result`

Body fields:

- `client_id` (string, required): The registered client being approved.
- `redirect_uri` (string, required): For the CLI this must be `urn:ietf:wg:oauth:2.0:oob` — the out-of-band pseudo-redirect, meaning the code is DISPLAYED rather than delivered anywhere. Nothing else is accepted for that client. Out-of-band because a redirect assumes the browser and the client are on the same machine, which is false for anyone signing in on a server they reach over SSH. What makes redemption safe is PKCE, not the delivery address.
- `code_challenge` (string, required): Base64url SHA-256 of the client's PKCE verifier, without padding.
- `code_challenge_method` (string, required): S256 only. `plain` is refused rather than merely discouraged: whoever intercepts the code also saw the challenge, so a plain challenge protects nothing.
- `state` (string): Opaque value echoed back on the redirect, unchanged. The client generated it and compares it on return.
- `organization` (string, required): Organization UUID to select for the session. Display names are not accepted. The signed-in user must be a member.

### `iam()->createPersonalSSHKey()`

Add personal SSH key

`POST /v1/auth/ssh-keys` → `Result`

Body fields:

- `name` (string, required): 
- `public_key` (string, required): One OpenSSH public key. Ed25519, ECDSA, security-key variants, and RSA of at least 2048 bits are supported. Private keys, certificates, multiple keys and authorized_keys options are rejected.
- `expires_at` (string): Optional expiry at least one minute in the future. Rotation requires a new credential and revocation of the old one.

### `iam()->createPolicy()`

Create policy

`POST /v1/policies` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 
- `document` (object, required): IAM-style policy document

### `iam()->createRole()`

Create role

`POST /v1/roles` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 
- `trust_policy` (object): Defines who/what can assume this role using CRN patterns

### `iam()->createServiceAccount()`

Create service account

`POST /v1/service-accounts` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Immutable account-scoped name. The Linux login is sa_<name>. Resource names must not start with the literal crn: prefix or be UUIDs.
- `description` (string): 
- `tags` (object): 

### `iam()->createServiceAccountCredential()`

Create credential

`POST /v1/service-accounts/{service_account_id}/credentials` → `Result`

Path arguments, in order: `serviceAccountId`.

Body fields:

- `name` (string, required): 
- `expires_at` (string): Optional expiration date

### `iam()->createServiceAccountSSHKey()`

Add service-account SSH key

`POST /v1/service-accounts/{service_account_id}/ssh-keys` → `Result`

Path arguments, in order: `serviceAccountId`.

Body fields:

- `name` (string, required): 
- `public_key` (string, required): One OpenSSH public key. Ed25519, ECDSA, security-key variants, and RSA of at least 2048 bits are supported. Private keys, certificates, multiple keys and authorized_keys options are rejected.
- `expires_at` (string): Optional expiry at least one minute in the future. Rotation requires a new credential and revocation of the old one.

### `iam()->deletePersonalSSHKey()`

Revoke personal SSH key

`DELETE /v1/auth/ssh-keys/{ssh_key_id}` → `void`

Path arguments, in order: `sshKeyId`.

### `iam()->deletePolicy()`

Delete policy

`DELETE /v1/policies/{policy_id}` → `void`

Path arguments, in order: `policyId`.

### `iam()->deleteRole()`

Delete role

`DELETE /v1/roles/{role_id}` → `void`

Path arguments, in order: `roleId`.

### `iam()->deleteRoleInlinePolicy()`

Delete a role's inline policy by name

`DELETE /v1/roles/{role_id}/inline-policies/{policy_name}` → `void`

Path arguments, in order: `roleId`, `policyName`.

### `iam()->deleteServiceAccount()`

Delete service account

`DELETE /v1/service-accounts/{service_account_id}` → `void`

Path arguments, in order: `serviceAccountId`.

### `iam()->deleteServiceAccountCredential()`

Delete credential

`DELETE /v1/service-accounts/{service_account_id}/credentials/{credential_id}` → `void`

Path arguments, in order: `serviceAccountId`, `credentialId`.

### `iam()->deleteServiceAccountInlinePolicy()`

Delete a service account's inline policy by name

`DELETE /v1/service-accounts/{service_account_id}/inline-policies/{policy_name}` → `void`

Path arguments, in order: `serviceAccountId`, `policyName`.

### `iam()->deleteServiceAccountSSHKey()`

Revoke service-account SSH key

`DELETE /v1/service-accounts/{service_account_id}/ssh-keys/{ssh_key_id}` → `void`

Path arguments, in order: `serviceAccountId`, `sshKeyId`.

### `iam()->detachRolePolicy()`

Detach policy from role

`DELETE /v1/roles/{role_id}/policies/{policy_id}` → `void`

Path arguments, in order: `roleId`, `policyId`.

### `iam()->detachServiceAccountPolicy()`

Detach policy from service account

`DELETE /v1/service-accounts/{service_account_id}/policies/{policy_id}` → `void`

Path arguments, in order: `serviceAccountId`, `policyId`.

### `iam()->getOAuthToken()`

Exchange an access key for a bearer token

`POST /v1/oauth/token` → `Result`

Body fields:

- `grant_type` (string, required): `client_credentials` is the one to use for a service account: it exchanges an access key pair for a token, and needs nothing else. `authorization_code` and `refresh_token` belong to the interactive login a person runs (`basaltic login`), where the token names a USER rather than a service account. They are driven by the CLI, not written by hand. Check the authorization-server metadata document before branching on them — they are advertised only where an authorization endpoint is configured.
- `client_id` (string): The access key id. Omit when using HTTP Basic.
- `client_secret` (string): The secret access key. Omit when using HTTP Basic.
- `duration_seconds` (integer): Requested token lifetime. A Basaltic extension, not an OAuth parameter — omit it and you get the default. Values outside the range are clamped into it rather than refused, so asking for a day yields the longest token allowed.
- `code` (string): The authorization code from the consent redirect. Single use, and valid for five minutes. `authorization_code` grant only.
- `code_verifier` (string): The PKCE verifier whose SHA-256 was sent as `code_challenge` when the flow started (RFC 7636). Required with `authorization_code`: it is what proves this is the client that began the flow, since a CLI holds no client secret.
- `redirect_uri` (string): The same `redirect_uri` the code was issued for — for the CLI, `urn:ietf:wg:oauth:2.0:oob`. Re-checked here, so a code cannot be redeemed under a different one (RFC 6749 4.1.3).
- `refresh_token` (string): `refresh_token` grant only. Renews a user session without another trip through the browser. Rotated on every use — store the new one.

### `iam()->getPersonalLinuxIdentity()`

Get personal Linux identity

`GET /v1/auth/linux-identity` → `Result`

`getPolicyByReference(...)` resolves an ID, CRN, or scoped name.

### `iam()->getPolicy()`

Get policy

`GET /v1/policies/{policy_id}` → `Result`

Path arguments, in order: `policyId`.

`getRoleByReference(...)` resolves an ID, CRN, or scoped name.

### `iam()->getRole()`

Get role

`GET /v1/roles/{role_id}` → `Result`

Path arguments, in order: `roleId`.

`getRoleInlinePolicyByReference(...)` resolves an ID, CRN, or scoped name.

### `iam()->getRoleInlinePolicy()`

Get a role's inline policy by name

`GET /v1/roles/{role_id}/inline-policies/{policy_name}` → `Result`

Path arguments, in order: `roleId`, `policyName`.

### `iam()->getRolePermissionBoundary()`

Get a role's permission boundary

`GET /v1/roles/{role_id}/permission-boundary` → `Result`

Path arguments, in order: `roleId`.

`getSTSSessionByReference(...)` resolves an ID, CRN, or scoped name.

### `iam()->getSTSSession()`

Get STS session

`GET /v1/sts-sessions/{session_id}` → `Result`

Path arguments, in order: `sessionId`.

`getServiceAccountByReference(...)` resolves an ID, CRN, or scoped name.

### `iam()->getServiceAccount()`

Get service account

`GET /v1/service-accounts/{service_account_id}` → `Result`

Path arguments, in order: `serviceAccountId`.

`getServiceAccountInlinePolicyByReference(...)` resolves an ID, CRN, or scoped name.

### `iam()->getServiceAccountInlinePolicy()`

Get a service account's inline policy by name

`GET /v1/service-accounts/{service_account_id}/inline-policies/{policy_name}` → `Result`

Path arguments, in order: `serviceAccountId`, `policyName`.

### `iam()->getServiceAccountLinuxIdentity()`

Get serviceaccount Linux identity

`GET /v1/service-accounts/{service_account_id}/linux-identity` → `Result`

Path arguments, in order: `serviceAccountId`.

### `iam()->getServiceAccountPermissionBoundary()`

Get a service account's permission boundary

`GET /v1/service-accounts/{service_account_id}/permission-boundary` → `Result`

Path arguments, in order: `serviceAccountId`.

### `iam()->listPersonalSSHKeys()`

List personal SSH keys

`GET /v1/auth/ssh-keys` → `Page`

### `iam()->listPolicies()`

List policies

`GET /v1/policies` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `iam()->listPolicyRoles()`

List roles with policy

`GET /v1/policies/{policy_id}/roles` → `Page`

Path arguments, in order: `policyId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `iam()->listPolicyServiceAccounts()`

List service accounts with policy

`GET /v1/policies/{policy_id}/service-accounts` → `Page`

Path arguments, in order: `policyId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `iam()->listRegions()`

List regions (legacy IAM)

`GET /v1/regions` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `iam()->listRoleInlinePolicies()`

List a role's inline policies

`GET /v1/roles/{role_id}/inline-policies` → `Page`

Path arguments, in order: `roleId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `iam()->listRolePolicies()`

List role policies

`GET /v1/roles/{role_id}/policies` → `Page`

Path arguments, in order: `roleId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `iam()->listRoles()`

List roles

`GET /v1/roles` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `iam()->listSTSSessions()`

List STS sessions

`GET /v1/sts-sessions` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `role` (string): Role UUID, immutable name, or account-qualified role CRN.
- `principal` (string): Principal reference; principal_type is required. Users and assumed-role sessions accept UUID or CRN; roles and service accounts also accept names in the owning account.
- `principal_type` (string): Filter by principal type. `assumed_role` selects the sessions role chaining produces, where an existing assumed-role session assumed another role.
- `active_only` (boolean): Only show active (non-expired, non-revoked) sessions
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `iam()->listServiceAccountCredentials()`

List credentials

`GET /v1/service-accounts/{service_account_id}/credentials` → `Page`

Path arguments, in order: `serviceAccountId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `iam()->listServiceAccountInlinePolicies()`

List a service account's inline policies

`GET /v1/service-accounts/{service_account_id}/inline-policies` → `Page`

Path arguments, in order: `serviceAccountId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `iam()->listServiceAccountPolicies()`

List service account policies

`GET /v1/service-accounts/{service_account_id}/policies` → `Page`

Path arguments, in order: `serviceAccountId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `iam()->listServiceAccountSSHKeys()`

List service-account SSH keys

`GET /v1/service-accounts/{service_account_id}/ssh-keys` → `Page`

Path arguments, in order: `serviceAccountId`.

### `iam()->listServiceAccounts()`

List service accounts

`GET /v1/service-accounts` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `iam()->putRoleInlinePolicy()`

Create or replace a role's inline policy

`PUT /v1/roles/{role_id}/inline-policies/{policy_name}` → `Result`

Path arguments, in order: `roleId`, `policyName`.

Body fields:

- `document` (object, required): IAM-style policy document

### `iam()->putServiceAccountInlinePolicy()`

Create or replace a service account's inline policy

`PUT /v1/service-accounts/{service_account_id}/inline-policies/{policy_name}` → `Result`

Path arguments, in order: `serviceAccountId`, `policyName`.

Body fields:

- `document` (object, required): IAM-style policy document

### `iam()->removeRolePermissionBoundary()`

Remove a role's permission boundary

`DELETE /v1/roles/{role_id}/permission-boundary` → `void`

Path arguments, in order: `roleId`.

### `iam()->removeServiceAccountPermissionBoundary()`

Remove a service account's permission boundary

`DELETE /v1/service-accounts/{service_account_id}/permission-boundary` → `void`

Path arguments, in order: `serviceAccountId`.

### `iam()->revokeOAuthToken()`

Revoke a bearer token

`POST /v1/oauth/revoke` → `void`

Body fields:

- `token` (string, required): The access token to revoke.
- `token_type_hint` (string): Accepted and ignored — the token identifies itself. Present because RFC 7009 clients send it.

### `iam()->revokeSTSSession()`

Revoke STS session

`DELETE /v1/sts-sessions/{session_id}` → `Result`

Path arguments, in order: `sessionId`.

Body fields:

- `reason` (string): Reason for revoking the session

### `iam()->setRolePermissionBoundary()`

Set a role's permission boundary

`PUT /v1/roles/{role_id}/permission-boundary` → `void`

Path arguments, in order: `roleId`.

Body fields:

- `policy` (string, required): Account policy UUID, immutable name in the selected account, or account-qualified IAM CRN. Shared system policies use crn:iam:::policy/<name>. CRNs select one namespace without fallback.

### `iam()->setServiceAccountPermissionBoundary()`

Set a service account's permission boundary

`PUT /v1/service-accounts/{service_account_id}/permission-boundary` → `void`

Path arguments, in order: `serviceAccountId`.

Body fields:

- `policy` (string, required): Account policy UUID, immutable name in the selected account, or account-qualified IAM CRN. Shared system policies use crn:iam:::policy/<name>. CRNs select one namespace without fallback.

### `iam()->updatePolicy()`

Update policy

`PATCH /v1/policies/{policy_id}` → `Result`

Path arguments, in order: `policyId`.

Body fields:

- `description` (string): 
- `tags` (object): 
- `document` (object): IAM-style policy document

### `iam()->updateRole()`

Update role

`PATCH /v1/roles/{role_id}` → `Result`

Path arguments, in order: `roleId`.

Body fields:

- `description` (string): 
- `tags` (object): 
- `trust_policy` (object): Defines who/what can assume this role using CRN patterns

### `iam()->updateServiceAccount()`

Update service account

`PATCH /v1/service-accounts/{service_account_id}` → `Result`

Path arguments, in order: `serviceAccountId`.

Body fields:

- `description` (string): 
- `tags` (object): 
- `enabled` (boolean): 

## Kms

### `kms()->cancelKeyDeletion()`

Cancel a scheduled deletion

`POST /v1/keys/{key_id}/cancel-deletion` → `Result`

Path arguments, in order: `keyId`.

### `kms()->createKey()`

Create a KMS key

`POST /v1/keys` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Unique per account. Surfaces in the CRN (crn:kms:<region>:<account>:key/<name>) — letters, digits, dot, dash, underscore. Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 
- `key_spec` (string, required): Cryptographic spec. Determines which mechanisms apply: - aes-256: symmetric AEAD (AES-GCM) - rsa-2048: asymmetric; OAEP-SHA256 encrypt + PSS-SHA256 sign - rsa-4096: same as rsa-2048 - ecdsa-p256: asymmetric; SHA-256 sign/verify (no encrypt)
- `key_usage` (string): Required for RSA specs (both encrypt_decrypt and sign_verify are valid). Defaults to encrypt_decrypt for AES, sign_verify for ECDSA.

### `kms()->decrypt()`

Decrypt a ciphertext

`POST /v1/keys/{key_id}/decrypt` → `Result`

Path arguments, in order: `keyId`.

Body fields:

- `ciphertext` (string, required): Base64-encoded ciphertext produced by Encrypt.
- `aad` (string): Optional base64-encoded AAD. Must match what was supplied at Encrypt — different value fails the tag check.

### `kms()->disableKey()`

Disable a key

`POST /v1/keys/{key_id}/disable` → `Result`

Path arguments, in order: `keyId`.

### `kms()->enableKey()`

Enable a disabled key

`POST /v1/keys/{key_id}/enable` → `Result`

Path arguments, in order: `keyId`.

### `kms()->encrypt()`

Encrypt a payload

`POST /v1/keys/{key_id}/encrypt` → `Result`

Path arguments, in order: `keyId`.

Body fields:

- `plaintext` (string, required): Base64-encoded plaintext.
- `aad` (string): Optional base64-encoded additional authenticated data (AES-GCM AEAD). Must be supplied verbatim to Decrypt; mismatch fails the auth tag check. Ignored for asymmetric keys.

### `kms()->generateDataKey()`

Generate a fresh data key

`POST /v1/keys/{key_id}/generate-data-key` → `Result`

Path arguments, in order: `keyId`.

Body fields:

- `number_of_bytes` (integer): Size of the generated data key in bytes: 16 (AES-128), 32 (AES-256, the default) or 64 (HMAC-SHA512). No other size is supported — the HSM mints data keys at those three widths only, and any other value fails the operation.

`getKeyByReference(...)` resolves an ID, CRN, or scoped name.

### `kms()->getKey()`

Get a KMS key

`GET /v1/keys/{key_id}` → `Result`

Path arguments, in order: `keyId`.

### `kms()->listKeys()`

List KMS keys

`GET /v1/keys` → `Page`

Query fields:

- `limit` (integer): 
- `marker` (string): Resume token — the last key id from the previous page.
- `state` (string): Optional state filter (enabled / disabled / pending_deletion).
- `name` (string): Exact, case-sensitive account-scoped key name. Combined with other filters.
- `crn` (string): Exact KMS key CRN in the authenticated account and current region. Malformed or empty CRNs return 400; valid foreign or mismatched CRNs return an empty page. Combined with name and state filters.

### `kms()->scheduleKeyDeletion()`

Schedule key for deletion

`POST /v1/keys/{key_id}/schedule-deletion` → `Result`

Path arguments, in order: `keyId`.

Body fields:

- `recovery_window_days` (integer): How long the key sits in pending_deletion before it is hard-deleted. Matches AWS KMS bounds; the deletion can be cancelled at any point inside the window.

### `kms()->sign()`

Sign a message

`POST /v1/keys/{key_id}/sign` → `Result`

Path arguments, in order: `keyId`.

Body fields:

- `message` (string, required): Base64-encoded message to sign. The service hashes it via SHA-256 server-side, so pass the raw payload — do not pre-hash.
- `signing_algorithm` (string): Signing algorithm for asymmetric Sign / Verify. Optional in requests — when omitted, the service picks the default for the key spec (RSA → RSASSA_PSS_SHA_256, ECDSA → ECDSA_SHA_256). Must match the key spec: RSA keys accept the two RSASSA schemes, ECDSA keys accept ECDSA_SHA_256.

### `kms()->updateKey()`

Update key metadata

`PATCH /v1/keys/{key_id}` → `Result`

Path arguments, in order: `keyId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `kms()->verify()`

Verify a signature

`POST /v1/keys/{key_id}/verify` → `Result`

Path arguments, in order: `keyId`.

Body fields:

- `message` (string, required): Base64-encoded original message.
- `signature` (string, required): Base64-encoded signature produced by Sign.
- `signing_algorithm` (string): Signing algorithm for asymmetric Sign / Verify. Optional in requests — when omitted, the service picks the default for the key spec (RSA → RSASSA_PSS_SHA_256, ECDSA → ECDSA_SHA_256). Must match the key spec: RSA keys accept the two RSASSA schemes, ECDSA keys accept ECDSA_SHA_256.

## Loadbalancer

### `loadbalancer()->attachListenerCertificate()`

Attach an additional certificate to an HTTPS listener

`POST /v1/load-balancers/{id}/listeners/{listener_id}/certificates` → `Result`

Path arguments, in order: `id`, `listenerId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `certificate` (string, required): The certificate to serve, by CRN, UUID or exact account-scoped name. Certificate CRNs require an empty region. The listener stores a reference — no key material is sent here, and the replicas fetch it from the certificate service under their own identity.
- `is_default` (boolean): When true, demote whatever's currently default and promote this cert in the same transaction.

### `loadbalancer()->attachTarget()`

Attach a target to this group

`POST /v1/target-groups/{id}/targets` → `Result`

Path arguments, in order: `id`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `target` (string, required): Must match the group's target_type: an IP address for `ip`, a compute instance UUID, CRN or exact account-scoped name for `instance`. An `ip` ref has to be a routable unicast address — loopback, link-local (including the 169.254.169.254 metadata endpoint), multicast, and unspecified addresses are rejected.
- `port` (integer): 

### `loadbalancer()->createListener()`

Create a listener on this load balancer

`POST /v1/load-balancers/{id}/listeners` → `Result`

Path arguments, in order: `id`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `protocol` (string, required): 
- `port` (integer, required): 
- `certificates` (array): 
- `default_target_group` (string): 
- `exposure` (string): Which LB addresses are bound. Defaults to 'both'; pick private_only when the LB has no FIP yet.
- `tags` (object): 

### `loadbalancer()->createLoadBalancer()`

Create a load balancer

`POST /v1/load-balancers` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): 1..127 chars of [A-Za-z0-9._-] Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `type` (string, required): 
- `vpc` (string, required): VPC the LB will live in. Must match subnet's VPC.
- `subnet` (string, required): Subnet the LB instances attach to. The virtual IP is allocated from this subnet.
- `flavor` (string, required): Compute flavor for each LB instance.
- `replica_count` (integer): Number of LB compute instances. Defaults to 1; pick >=2 for HA.
- `floating_ip` (string): Public IPv4 shorthand. Cannot be combined with floating_ips. Does not allocate public IPv6.
- `floating_ips` (array): Existing free floating IPs from this account and region, at most one per family and visibility (private/public, IPv4/IPv6). Private addresses must belong to the selected subnet. Missing private families are allocated automatically for each family enabled on that subnet. Public addresses are optional and require a matching-family default route to an internet gateway; NAT and egress-only gateways do not qualify. IPv6 requires an IPv6-enabled subnet. Pool-owned or attached addresses are unavailable. On deletion, supplied addresses are detached and retained; automatic private allocations are released. Cannot be combined with floating_ip.
- `security_groups` (array, required): Security groups attached to every replica NIC (AWS ALB shape). A VPC NIC with no security group denies all data traffic, so the listener port(s) must be opened by a security group listed here. Re-applied to replacement replicas. The LB's own control-plane path (agent config + heartbeat via the metadata endpoint) is always-allowed and needs none.
- `tags` (object): 

### `loadbalancer()->createRule()`

Create a routing rule on this listener (HTTP/HTTPS only)

`POST /v1/load-balancers/{id}/listeners/{listener_id}/rules` → `Result`

Path arguments, in order: `id`, `listenerId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `priority` (integer, required): 
- `conditions` (array, required): 
- `target_group` (string, required): 

### `loadbalancer()->createTargetGroup()`

Create a target group

`POST /v1/target-groups` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `protocol` (string, required): 
- `target_type` (string): 
- `port` (integer, required): 
- `health_check` (object): Active probes are enabled by default. Set enabled=false to stop probes while retaining their configuration. An explicitly enabled HTTP/HTTPS check requires a non-empty path starting with /. TCP checks connect to the check port without an HTTP path. UDP groups default to TCP connect probes.
- `proxy_protocol` (boolean): 
- `session_affinity` (object): Sticky sessions: pin a client to one backend in the group instead of balancing each request independently. Off unless you ask for it. The data plane hashes the key consistently, so adding or losing a backend only moves the clients that backend was serving.
- `target_mode` (string): `static` (the default) takes the backends you attach as targets. `pool` takes them from a compute instance pool and requires instance_pool; the group is forced to target_type=instance, and attaching targets to it is rejected.
- `instance_pool` (string): Compute instance pool to draw backends from. Required when target_mode=pool and must belong to the calling account; ignored otherwise.
- `tags` (object): 

### `loadbalancer()->deleteListener()`

Delete a listener

`DELETE /v1/load-balancers/{id}/listeners/{listener_id}` → `void`

Path arguments, in order: `id`, `listenerId`.

### `loadbalancer()->deleteLoadBalancer()`

Delete a load balancer

`DELETE /v1/load-balancers/{id}` → `void`

Path arguments, in order: `id`.

### `loadbalancer()->deleteRuleInListener()`

Delete a routing rule

`DELETE /v1/load-balancers/{id}/listeners/{listener_id}/rules/{rule_id}` → `void`

Path arguments, in order: `id`, `listenerId`, `ruleId`.

### `loadbalancer()->deleteTargetGroup()`

Delete a target group

`DELETE /v1/target-groups/{id}` → `void`

Path arguments, in order: `id`.

### `loadbalancer()->detachListenerCertificate()`

Detach a certificate from an HTTPS listener

`DELETE /v1/load-balancers/{id}/listeners/{listener_id}/certificates/{certificate_id}` → `void`

Path arguments, in order: `id`, `listenerId`, `certificateId`.

### `loadbalancer()->detachTarget()`

Detach a target

`DELETE /v1/target-groups/{id}/targets/{target_id}` → `void`

Path arguments, in order: `id`, `targetId`.

`getListenerByReference(...)` resolves an ID, CRN, or scoped name.

### `loadbalancer()->getListener()`

Get a listener

`GET /v1/load-balancers/{id}/listeners/{listener_id}` → `Result`

Path arguments, in order: `id`, `listenerId`.

`getLoadBalancerByReference(...)` resolves an ID, CRN, or scoped name.

### `loadbalancer()->getLoadBalancer()`

Get a load balancer

`GET /v1/load-balancers/{id}` → `Result`

Path arguments, in order: `id`.

`getRuleByReference(...)` resolves an ID, CRN, or scoped name.

### `loadbalancer()->getRule()`

Get a routing rule

`GET /v1/load-balancers/{id}/listeners/{listener_id}/rules/{rule_id}` → `Result`

Path arguments, in order: `id`, `listenerId`, `ruleId`.

`getTargetByReference(...)` resolves an ID, CRN, or scoped name.

### `loadbalancer()->getTarget()`

Get a target

`GET /v1/target-groups/{id}/targets/{target_id}` → `Result`

Path arguments, in order: `id`, `targetId`.

`getTargetGroupByReference(...)` resolves an ID, CRN, or scoped name.

### `loadbalancer()->getTargetGroup()`

Get a target group

`GET /v1/target-groups/{id}` → `Result`

Path arguments, in order: `id`.

### `loadbalancer()->listListeners()`

List this load balancer's listeners

`GET /v1/load-balancers/{id}/listeners` → `Page`

Path arguments, in order: `id`.

Query fields:

- `name` (string): Exact immutable name. An empty value or a resource without a name selects no rows.
- `crn` (string): Exact scoped CRN. Foreign or mismatched CRNs select no rows; malformed or empty CRNs return 400.

### `loadbalancer()->listLoadBalancerReplicas()`

List the LB's instance replicas with live health

`GET /v1/load-balancers/{id}/replicas` → `Page`

Path arguments, in order: `id`.

Query fields:

- `name` (string): Exact immutable name. An empty value or a resource without a name selects no rows.
- `crn` (string): Exact scoped CRN. Foreign or mismatched CRNs select no rows; malformed or empty CRNs return 400.

### `loadbalancer()->listLoadBalancers()`

List load balancers

`GET /v1/load-balancers` → `Page`

Query fields:

- `name` (string): Exact immutable name. An empty value or a resource without a name selects no rows.
- `crn` (string): Exact scoped CRN. Foreign or mismatched CRNs select no rows; malformed or empty CRNs return 400.
- `status` (string): 
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `loadbalancer()->listRules()`

List this listener's rules

`GET /v1/load-balancers/{id}/listeners/{listener_id}/rules` → `Page`

Path arguments, in order: `id`, `listenerId`.

Query fields:

- `name` (string): Exact immutable name. An empty value or a resource without a name selects no rows.
- `crn` (string): Exact scoped CRN. Foreign or mismatched CRNs select no rows; malformed or empty CRNs return 400.

### `loadbalancer()->listTargetGroups()`

List target groups

`GET /v1/target-groups` → `Page`

Query fields:

- `name` (string): Exact immutable name. An empty value or a resource without a name selects no rows.
- `crn` (string): Exact scoped CRN. Foreign or mismatched CRNs select no rows; malformed or empty CRNs return 400.
- `protocol` (string): 
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `loadbalancer()->listTargets()`

List targets in this group

`GET /v1/target-groups/{id}/targets` → `Page`

Path arguments, in order: `id`.

Query fields:

- `name` (string): Exact immutable name. An empty value or a resource without a name selects no rows.
- `crn` (string): Exact scoped CRN. Foreign or mismatched CRNs select no rows; malformed or empty CRNs return 400.

### `loadbalancer()->updateListener()`

Patch a listener (rotate cert, change default target group)

`PATCH /v1/load-balancers/{id}/listeners/{listener_id}` → `Result`

Path arguments, in order: `id`, `listenerId`.

Body fields:

- `certificate` (string): 
- `default_target_group` (string): 
- `clear_default_target_group` (boolean): 
- `exposure` (string): Mutate which addresses are bound. Omit to leave unchanged.
- `tags` (object): 

### `loadbalancer()->updateLoadBalancer()`

Scale or resize a load balancer

`PATCH /v1/load-balancers/{id}` → `Result`

Path arguments, in order: `id`.

Body fields:

- `replica_count` (integer): Resize the set of load balancer instances. Scale-out provisions the new replicas in sequence; scale-in removes the highest-indexed replicas best-effort. 1..10.
- `flavor` (string): Resize each replica to a different compute flavor. Must be a loadbalancer-family flavor. A running instance cannot change size in place, so the request records the new size and returns; the replicas already up are then replaced one at a time in the background. The load balancer temporarily runs one replica over replica_count while it does: the extra replica comes up on the new flavor and starts serving before any replica on the old one is retired, so the number serving never drops below replica_count — a resize does not cost you capacity, at any replica count. Expect it to take several minutes, and poll GET /v1/load-balancers/{id}/replicas to watch: a replica has been replaced when its instance_id changes, and the resize is done when every flavor there matches this one. The one exception is a load balancer already at the maximum of 10 replicas, which has nowhere to grow. There the replicas are replaced in place and 9 serve while each replacement boots. Rejected up front if the account does not have the compute quota for the replacement replica, so a resize cannot half-apply and leave the load balancer short.
- `tags` (object): 

### `loadbalancer()->updateRule()`

Update a routing rule (full replace)

`PATCH /v1/load-balancers/{id}/listeners/{listener_id}/rules/{rule_id}` → `Result`

Path arguments, in order: `id`, `listenerId`, `ruleId`.

Body fields:

- `priority` (integer, required): 
- `conditions` (array, required): 
- `target_group` (string, required): 

### `loadbalancer()->updateTargetGroup()`

Update target group health checks, framing, or stickiness

`PATCH /v1/target-groups/{id}` → `Result`

Path arguments, in order: `id`.

Body fields:

- `health_check` (object): Merge supplied fields into the existing check. Omitted fields are preserved; null or an empty object leaves the check unchanged. Set enabled=false to disable probes without clearing settings, and enabled=true to enable the saved configuration. Set port=0 to use each target's traffic port; zero timing/thresholds and an empty matcher reset their defaults. An empty protocol inherits the target group protocol. Clearing the path of an explicitly enabled HTTP/HTTPS check is invalid.
- `proxy_protocol` (boolean): Toggle PROXY v2 framing on upstream connections. Omitting the field leaves the current setting; setting true/false flips it explicitly.
- `session_affinity` (object): Replaces the stickiness config. Omitting the field leaves it alone; turning it off is an explicit `{"type": "none"}`.
- `tags` (object): 

## Network

### `network()->attachFloatingIp()`

Attach a floating IP to an interface

`POST /v1/floating-ips/{floating_ip_id}/attach` → `Result`

Path arguments, in order: `floatingIpId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `interface` (string, required): Interface UUID or nested CRN. Bare names have no subnet scope and are rejected.
- `address_id` (string, required): 

### `network()->attachInternetGateway()`

Attach internet gateway to a VPC

`POST /v1/internet-gateways/{internet_gateway_id}/attach` → `Result`

Path arguments, in order: `internetGatewayId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `vpc` (string, required): VPC UUID, CRN or exact name in the caller account.

### `network()->createEgressOnlyGateway()`

Create egress-only gateway

`POST /v1/egress-only-gateways` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `vpc` (string, required): VPC UUID, CRN or exact name in the caller account.
- `tags` (object): 

### `network()->createFloatingIp()`

Allocate floating IP

`POST /v1/floating-ips` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `description` (string): 
- `family` (string): Which family to allocate in. Fixed for the life of the address — it decides the pool the address comes from, the quota it counts against (`floating_ips_v4` or `floating_ips_v6`) and the SKU it bills as. Omitted means `ipv4`.
- `tags` (object): 
- `health_check` (object): An optional readiness check for the address's members. Omitted means none — the address behaves exactly as an ordinary floating IP.
- `visibility` (string): 
- `subnet` (string): Required for private floating IPs; subnet UUID or CRN in this account. Targets may be in other subnets of the same VPC.

### `network()->createInterface()`

Create interface

`POST /v1/interfaces` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `subnet` (string, required): Subnet UUID or nested CRN (vpc/<vpc>/subnet/<subnet>). A bare name requires an explicit VPC filter; create requests without a VPC do not accept bare names.
- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `mac` (string): Defaults to a fresh locally-administered EUI-48
- `tags` (object): 
- `addresses` (array): Every enabled subnet family is allocated automatically. Entries may request a fixed IPv4 address; omitting a family never disables it. At most one entry per family.

### `network()->createInterfaceAddress()`

Create interface address

`POST /v1/interfaces/{interface_id}/addresses` → `Result`

Path arguments, in order: `interfaceId`.

Body fields:

- `family` (string, required): 
- `address` (string): Optional fixed address when creating an interface or instance NIC. For IPv6, use the first address of an aligned /96 inside the subnet /64 (last 32 bits zero); the first and last /96 ranges are reserved. Omit for automatic allocation. Managed database nodes and the add-address operation require automatic allocation.

### `network()->createInterfacePrefix()`

Create interface prefix

`POST /v1/interfaces/{interface_id}/prefixes` → `Result`

Path arguments, in order: `interfaceId`.

Body fields:

- `pool_id` (string, required): 

### `network()->createInternetGateway()`

Create internet gateway

`POST /v1/internet-gateways` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 

### `network()->createNATGateway()`

Create NAT gateway

`POST /v1/nat-gateways` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `subnet` (string, required): Subnet UUID or nested CRN (vpc/<vpc>/subnet/<subnet>). A bare name requires an explicit VPC filter; create requests without a VPC do not accept bare names.
- `tags` (object): 

### `network()->createPrefixPool()`

Create prefix pool

`POST /v1/vpcs/{vpc_id}/prefix-pools` → `Result`

Path arguments, in order: `vpcId`.

Body fields:

- `cidr_ipv4` (string, required): 

### `network()->createRoute()`

Create route

`POST /v1/route-tables/{route_table_id}/routes` → `Result`

Path arguments, in order: `routeTableId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `description` (string): 
- `destination_cidr` (string, required): 
- `next_hop_ip` (string): Unicast next hop inside this VPC's CIDR (same IP family as destination_cidr). Not for internet egress — use a gateway target id instead.
- `target_internet_gateway` (string): Gateway UUID, CRN or exact account-scoped name. Must belong to the route table VPC and match the destination_cidr address family. Exactly one route target is required.
- `target_nat_gateway` (string): Gateway UUID, CRN or exact account-scoped name. Must belong to the route table VPC and match the destination_cidr address family. Exactly one route target is required.
- `target_egress_only_gateway` (string): Gateway UUID, CRN or exact account-scoped name. Must belong to the route table VPC and match the destination_cidr address family. Exactly one route target is required.
- `tags` (object): 

### `network()->createRouteTable()`

Create route table

`POST /v1/route-tables` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `vpc` (string, required): VPC UUID, CRN or exact name in the caller account.
- `name` (string, required): 1-63 chars, lowercase alphanumeric + hyphen. `main` is reserved. Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 

### `network()->createSecurityGroup()`

Create security group

`POST /v1/security-groups` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 

### `network()->createSecurityGroupRule()`

Create security group rule

`POST /v1/security-groups/{security_group_id}/rules` → `Result`

Path arguments, in order: `securityGroupId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `description` (string): 
- `direction` (string, required): 
- `ethertype` (string): 
- `protocol` (string, required): 
- `port_min` (integer): 
- `port_max` (integer): 
- `remote_cidr` (string): 
- `source_security_group` (string): Security-group UUID, CRN or exact account-scoped name. Mutually exclusive with remote_cidr.

### `network()->createSubnet()`

Create subnet

`POST /v1/subnets` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `vpc` (string, required): VPC UUID, CRN or exact name in the caller account.
- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `cidr_ipv4` (string, required): 
- `gateway_ipv4` (string): Defaults to the first usable host in the CIDR
- `route_table` (string): Route-table UUID, nested CRN or exact name within the subnet VPC. On PATCH the owned path subnet supplies the VPC. Omission on create selects the default table; an empty reference is invalid.
- `allocate_cidr_ipv6` (boolean): Allocate a free /64 from the VPC IPv6 range. Can be enabled after creation. Every existing and new interface receives an IPv6 /96 and its first /128 automatically. NAT gateways hosted here also receive a public IPv6 address from the regional pool. Updating hosted gateways requires UpdateNATGateway permission and public IPv6 quota.
- `cidr_ipv6` (string): An aligned /64 inside the VPC IPv6 range. Can be added later; cannot replace an existing range. Mutually exclusive with allocate_cidr_ipv6.
- `tags` (object): 

### `network()->createVpc()`

Create VPC

`POST /v1/vpcs` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `cidr_ipv4` (string, required): Must be private (RFC 1918): within 10.0.0.0/8, 172.16.0.0/12 or 192.168.0.0/16.
- `allocate_cidr_ipv6` (boolean): Allocate a regional GUA /60. Mutually exclusive with cidr_ipv6. Existing IPv6 ranges cannot be replaced.
- `tags` (object): 
- `cidr_ipv6` (string): Optional aligned locally assigned ULA (fd00::/8), /48 through /60. May be added after VPC creation.

### `network()->deleteEgressOnlyGateway()`

Delete egress-only gateway

`DELETE /v1/egress-only-gateways/{egress_only_gateway_id}` → `void`

Path arguments, in order: `egressOnlyGatewayId`.

### `network()->deleteFloatingIp()`

Release floating IP

`DELETE /v1/floating-ips/{floating_ip_id}` → `void`

Path arguments, in order: `floatingIpId`.

### `network()->deleteInterface()`

Delete interface

`DELETE /v1/interfaces/{interface_id}` → `void`

Path arguments, in order: `interfaceId`.

### `network()->deleteInterfaceAddress()`

Delete interface address

`DELETE /v1/interfaces/{interface_id}/addresses/{address_id}` → `void`

Path arguments, in order: `interfaceId`, `addressId`.

### `network()->deleteInterfacePrefix()`

Delete interface prefix

`DELETE /v1/interfaces/{interface_id}/prefixes/{prefix_id}` → `void`

Path arguments, in order: `interfaceId`, `prefixId`.

### `network()->deleteInternetGateway()`

Delete internet gateway

`DELETE /v1/internet-gateways/{internet_gateway_id}` → `void`

Path arguments, in order: `internetGatewayId`.

### `network()->deleteNATGateway()`

Delete NAT gateway

`DELETE /v1/nat-gateways/{nat_gateway_id}` → `void`

Path arguments, in order: `natGatewayId`.

### `network()->deletePrefixPool()`

Delete prefix pool

`DELETE /v1/vpcs/{vpc_id}/prefix-pools/{pool_id}` → `void`

Path arguments, in order: `vpcId`, `poolId`.

### `network()->deleteRoute()`

Delete route

`DELETE /v1/route-tables/{route_table_id}/routes/{route_id}` → `void`

Path arguments, in order: `routeTableId`, `routeId`.

### `network()->deleteRouteTable()`

Delete route table

`DELETE /v1/route-tables/{route_table_id}` → `void`

Path arguments, in order: `routeTableId`.

### `network()->deleteSecurityGroup()`

Delete security group

`DELETE /v1/security-groups/{security_group_id}` → `void`

Path arguments, in order: `securityGroupId`.

### `network()->deleteSecurityGroupRule()`

Delete security group rule

`DELETE /v1/security-groups/{security_group_id}/rules/{rule_id}` → `void`

Path arguments, in order: `securityGroupId`, `ruleId`.

### `network()->deleteSubnet()`

Delete subnet

`DELETE /v1/subnets/{subnet_id}` → `void`

Path arguments, in order: `subnetId`.

### `network()->deleteVpc()`

Delete VPC

`DELETE /v1/vpcs/{vpc_id}` → `void`

Path arguments, in order: `vpcId`.

### `network()->detachFloatingIp()`

Detach a floating IP

`POST /v1/floating-ips/{floating_ip_id}/detach` → `Result`

Path arguments, in order: `floatingIpId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `interface` (string): Interface UUID or nested CRN; bare names, null and empty references are rejected. Omitting the field clears the binding. Naming a NIC that is not a member is a no-op.

### `network()->detachInternetGateway()`

Detach internet gateway from its VPC

`POST /v1/internet-gateways/{internet_gateway_id}/detach` → `Result`

Path arguments, in order: `internetGatewayId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

`getEgressOnlyGatewayByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getEgressOnlyGateway()`

Get egress-only gateway

`GET /v1/egress-only-gateways/{egress_only_gateway_id}` → `Result`

Path arguments, in order: `egressOnlyGatewayId`.

`getFloatingIpByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getFloatingIp()`

Get floating IP

`GET /v1/floating-ips/{floating_ip_id}` → `Result`

Path arguments, in order: `floatingIpId`.

`getInterfaceByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getInterface()`

Get interface

`GET /v1/interfaces/{interface_id}` → `Result`

Path arguments, in order: `interfaceId`.

### `network()->getInterfaceAddress()`

Get interface address

`GET /v1/interfaces/{interface_id}/addresses/{address_id}` → `Result`

Path arguments, in order: `interfaceId`, `addressId`.

`getInternetGatewayByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getInternetGateway()`

Get internet gateway

`GET /v1/internet-gateways/{internet_gateway_id}` → `Result`

Path arguments, in order: `internetGatewayId`.

`getNATGatewayByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getNATGateway()`

Get NAT gateway

`GET /v1/nat-gateways/{nat_gateway_id}` → `Result`

Path arguments, in order: `natGatewayId`.

`getRouteByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getRoute()`

Get route

`GET /v1/route-tables/{route_table_id}/routes/{route_id}` → `Result`

Path arguments, in order: `routeTableId`, `routeId`.

`getRouteTableByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getRouteTable()`

Get route table

`GET /v1/route-tables/{route_table_id}` → `Result`

Path arguments, in order: `routeTableId`.

`getSecurityGroupByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getSecurityGroup()`

Get security group

`GET /v1/security-groups/{security_group_id}` → `Result`

Path arguments, in order: `securityGroupId`.

`getSecurityGroupRuleByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getSecurityGroupRule()`

Get security group rule

`GET /v1/security-groups/{security_group_id}/rules/{rule_id}` → `Result`

Path arguments, in order: `securityGroupId`, `ruleId`.

`getSubnetByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getSubnet()`

Get subnet

`GET /v1/subnets/{subnet_id}` → `Result`

Path arguments, in order: `subnetId`.

`getVpcByReference(...)` resolves an ID, CRN, or scoped name.

### `network()->getVpc()`

Get VPC

`GET /v1/vpcs/{vpc_id}` → `Result`

Path arguments, in order: `vpcId`.

### `network()->listEgressOnlyGatewayRoutes()`

List egress-only gateway routes

`GET /v1/egress-only-gateways/{egress_only_gateway_id}/routes` → `Page`

Path arguments, in order: `egressOnlyGatewayId`.

Query fields:

- `name` (string): Exact resource name. This resource has no name, so a supplied name returns an empty result.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listEgressOnlyGateways()`

List egress-only gateways

`GET /v1/egress-only-gateways` → `Page`

Query fields:

- `name` (string): Exact resource name.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listFloatingIps()`

List floating IPs

`GET /v1/floating-ips` → `Page`

Query fields:

- `name` (string): Exact resource name. This resource has no name, so a supplied name returns an empty result.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `attached_to` (string): Exact attachment CRN: an interface for an ordinary binding, an instance pool (including a pool with zero members), or a load balancer. Applied before pagination and intersected with other filters. Malformed CRNs return 400; well-formed foreign or mismatched CRNs return an empty page.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listInterfaceAddresses()`

List interface addresses

`GET /v1/interfaces/{interface_id}/addresses` → `Page`

Path arguments, in order: `interfaceId`.

### `network()->listInterfacePrefixes()`

List interface prefixes

`GET /v1/interfaces/{interface_id}/prefixes` → `Page`

Path arguments, in order: `interfaceId`.

### `network()->listInterfaceSecurityGroups()`

List interface security-group membership

`GET /v1/interfaces/{interface_id}/security-groups` → `Page`

Path arguments, in order: `interfaceId`.

Query fields:

- `name` (string): Exact resource name.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.

### `network()->listInterfaces()`

List interfaces

`GET /v1/interfaces` → `Page`

Query fields:

- `name` (string): Exact resource name. Requires the subnet filter.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `subnet` (string): Subnet UUID or nested CRN; an exact bare name requires the vpc filter.
- `vpc` (string): VPC UUID, CRN or exact account-scoped name. Resolved before subnet.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listInternetGatewayRoutes()`

List internet gateway routes

`GET /v1/internet-gateways/{internet_gateway_id}/routes` → `Page`

Path arguments, in order: `internetGatewayId`.

Query fields:

- `name` (string): Exact resource name. This resource has no name, so a supplied name returns an empty result.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listInternetGateways()`

List internet gateways

`GET /v1/internet-gateways` → `Page`

Query fields:

- `name` (string): Exact resource name.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listNATGatewayRoutes()`

List NAT gateway routes

`GET /v1/nat-gateways/{nat_gateway_id}/routes` → `Page`

Path arguments, in order: `natGatewayId`.

Query fields:

- `name` (string): Exact resource name. This resource has no name, so a supplied name returns an empty result.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listNATGateways()`

List NAT gateways

`GET /v1/nat-gateways` → `Page`

Query fields:

- `name` (string): Exact resource name.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `subnet` (string): Subnet UUID or nested CRN; an exact bare name requires the vpc filter.
- `vpc` (string): VPC UUID, CRN or exact account-scoped name. Resolved before subnet.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listPrefixPools()`

List prefix pools

`GET /v1/vpcs/{vpc_id}/prefix-pools` → `Page`

Path arguments, in order: `vpcId`.

### `network()->listRouteTables()`

List route tables

`GET /v1/route-tables` → `Page`

Query fields:

- `name` (string): Exact resource name. Requires the vpc filter.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `vpc` (string): VPC UUID, CRN or exact name in the caller account.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listRoutes()`

List routes

`GET /v1/route-tables/{route_table_id}/routes` → `Page`

Path arguments, in order: `routeTableId`.

Query fields:

- `name` (string): Exact resource name. This resource has no name, so a supplied name returns an empty result.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listSecurityGroupRules()`

List security group rules

`GET /v1/security-groups/{security_group_id}/rules` → `Page`

Path arguments, in order: `securityGroupId`.

Query fields:

- `name` (string): Exact resource name. This resource has no name, so a supplied name returns an empty result.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listSecurityGroups()`

List security groups

`GET /v1/security-groups` → `Page`

Query fields:

- `name` (string): Exact resource name.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listSubnets()`

List subnets

`GET /v1/subnets` → `Page`

Query fields:

- `name` (string): Exact resource name. Requires the vpc filter.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `vpc` (string): VPC UUID, CRN or exact name in the caller account.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->listVpcs()`

List VPCs

`GET /v1/vpcs` → `Page`

Query fields:

- `name` (string): Exact resource name.
- `crn` (string): Exact CRN, validated against the endpoint type, region and caller account. Valid foreign or mismatched CRNs return an empty result; malformed or flat child CRNs return 400. Filters are conjunctive.
- `limit` (integer): 
- `marker` (string): Resume token — the last id from the previous page.

### `network()->setInterfaceSecurityGroups()`

Set interface security-group membership

`PUT /v1/interfaces/{interface_id}/security-groups` → `Result`

Path arguments, in order: `interfaceId`.

Body fields:

- `security_groups` (array, required): Security-group UUIDs, CRNs or account-scoped names. All entries resolve before replacement; duplicate canonical IDs collapse to one membership. An empty array removes all groups.

### `network()->updateEgressOnlyGateway()`

Update egress-only gateway

`PATCH /v1/egress-only-gateways/{egress_only_gateway_id}` → `Result`

Path arguments, in order: `egressOnlyGatewayId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `network()->updateFloatingIp()`

Update floating IP

`PATCH /v1/floating-ips/{floating_ip_id}` → `Result`

Path arguments, in order: `floatingIpId`.

Body fields:

- `description` (string): 
- `tags` (object): 
- `health_check` (object): Set (an object) or clear (null) the address's readiness check. Omit the field to leave it unchanged.

### `network()->updateInterface()`

Update interface

`PATCH /v1/interfaces/{interface_id}` → `Result`

Path arguments, in order: `interfaceId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `network()->updateInternetGateway()`

Update internet gateway

`PATCH /v1/internet-gateways/{internet_gateway_id}` → `Result`

Path arguments, in order: `internetGatewayId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `network()->updateNATGateway()`

Update NAT gateway

`PATCH /v1/nat-gateways/{nat_gateway_id}` → `Result`

Path arguments, in order: `natGatewayId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `network()->updateRoute()`

Update route

`PATCH /v1/route-tables/{route_table_id}/routes/{route_id}` → `Result`

Path arguments, in order: `routeTableId`, `routeId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `network()->updateRouteTable()`

Update route table

`PATCH /v1/route-tables/{route_table_id}` → `Result`

Path arguments, in order: `routeTableId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `network()->updateSecurityGroup()`

Update security group

`PATCH /v1/security-groups/{security_group_id}` → `Result`

Path arguments, in order: `securityGroupId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `network()->updateSubnet()`

Update subnet

`PATCH /v1/subnets/{subnet_id}` → `Result`

Path arguments, in order: `subnetId`.

Body fields:

- `description` (string): 
- `route_table` (string): Route-table UUID, nested CRN or exact name within the subnet VPC. On PATCH the owned path subnet supplies the VPC. Omission on create selects the default table; an empty reference is invalid.
- `tags` (object): 
- `allocate_cidr_ipv6` (boolean): Allocate a free /64 from the VPC IPv6 range. Can be enabled after creation. Every existing and new interface receives an IPv6 /96 and its first /128 automatically. NAT gateways hosted here also receive a public IPv6 address from the regional pool. Updating hosted gateways requires UpdateNATGateway permission and public IPv6 quota.
- `cidr_ipv6` (string): An aligned /64 inside the VPC IPv6 range. Can be added later; cannot replace an existing range. Mutually exclusive with allocate_cidr_ipv6.
- `copy_ipv4_security_rules` (boolean): When enabling IPv6, copy equivalent rules in security groups used by this subnet's interfaces. Copies 0.0.0.0/0 to ::/0 and security-group references, preserving protocol, ports and direction. Restricted IPv4 CIDRs are not widened. Existing IPv6 equivalents are not duplicated. Changes affect every interface sharing these groups. Requires CreateSecurityGroupRule permission and available rule quota. Only accepted with allocate_cidr_ipv6 or cidr_ipv6.
- `ipv6_routing` (string): When enabling IPv6, optionally add ::/0 to the subnet's route table. match_ipv4 follows an IPv4 internet-gateway or NAT-gateway default route, using the same target. A NAT gateway must already have IPv6 enabled on its hosting subnet, or be hosted in the subnet being enabled. No IPv4 default route leaves IPv6 routing unchanged. Existing IPv6 default routes are always preserved. Egress-only gateways cannot provide ULA internet access; use a NAT gateway, or a public IPv6 floating IP with an internet-gateway route. Changes affect every subnet sharing the route table and require CreateRoute permission; creating an egress-only gateway also requires CreateEgressOnlyGateway permission. Only accepted with allocate_cidr_ipv6 or cidr_ipv6.

### `network()->updateVpc()`

Update VPC

`PATCH /v1/vpcs/{vpc_id}` → `Result`

Path arguments, in order: `vpcId`.

Body fields:

- `description` (string): 
- `tags` (object): 
- `allocate_cidr_ipv6` (boolean): Allocate a regional GUA /60. Mutually exclusive with cidr_ipv6. Existing IPv6 ranges cannot be replaced.
- `cidr_ipv6` (string): Optional aligned locally assigned ULA (fd00::/8), /48 through /60. May be added after VPC creation.

## Quota

### `quota()->listQuotas()`

List quotas

`GET /v1/quotas` → `Page`

Query fields:

- `region` (string): Region to filter regional quotas by. Omit for global only.

## Secrets

### `secrets()->createSecret()`

Create a new secret with an initial value

`POST /v1/secrets` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Unique within the calling account. Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 
- `value` (string, required): Base64 of the initial value bytes (1 byte - 64 KiB).
- `recovery_window_days` (integer): 
- `kms_key` (string): UUID, CRN or account-scoped name of a customer-managed KMS key to encrypt this secret under. Omit to use the platform-managed default key. The key must be enabled and have encrypt/decrypt usage.

### `secrets()->deleteSecret()`

Schedule deletion (soft delete with recovery window)

`DELETE /v1/secrets/{secret_id}` → `Result`

Path arguments, in order: `secretId`.

Body fields:

- `recovery_window_days` (integer): Override the secret's stored window. Omit to keep it.

### `secrets()->describeSecret()`

Describe a secret (no value)

`GET /v1/secrets/{secret_id}` → `Result`

Path arguments, in order: `secretId`.

### `secrets()->getSecretValue()`

Read the current value (or a specific version)

`GET /v1/secrets/{secret_id}/value` → `Result`

Path arguments, in order: `secretId`.

Query fields:

- `version` (integer): Specific version to read. Omit for current.

### `secrets()->listSecrets()`

List secrets

`GET /v1/secrets` → `Page`

Query fields:

- `name` (string): Exact, case-sensitive secret name in the calling account. Empty values match nothing.
- `crn` (string): Exact secret CRN in the calling account and current region. Malformed or empty CRNs return 400; valid foreign-account, foreign-region or wrong-type CRNs return an empty page. Combined filters intersect; conflicting name and CRN filters return an empty page. With include_deleted, a reused name can match both deleted and active secrets.
- `include_deleted` (boolean): Include secrets in the recovery window.
- `marker` (string): 
- `limit` (integer): Maximum items to return. A larger value is clamped to the maximum rather than rejected, so page until `meta.has_more` is false.

### `secrets()->listVersions()`

List versions

`GET /v1/secrets/{secret_id}/versions` → `Page`

Path arguments, in order: `secretId`.

Query fields:

- `crn` (string): Exact secret/name/version/number CRN; foreign or mismatched identities return an empty page.
- `marker` (string): 
- `limit` (integer): Maximum items to return. A larger value is clamped to the maximum rather than rejected, so page until `meta.has_more` is false.

### `secrets()->putSecretValue()`

Store a new version (becomes current)

`POST /v1/secrets/{secret_id}/value` → `Result`

Path arguments, in order: `secretId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `value` (string, required): Base64 of the new value bytes (1 byte - 64 KiB).

### `secrets()->restoreSecret()`

Restore a secret from the recovery window

`POST /v1/secrets/{secret_id}/restore` → `Result`

Path arguments, in order: `secretId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

### `secrets()->updateSecret()`

Update mutable metadata

`PATCH /v1/secrets/{secret_id}` → `Result`

Path arguments, in order: `secretId`.

Body fields:

- `description` (string): 
- `tags` (object): 

## Storage

### `storage()->abortMultipartUpload()`

Abort a multipart upload

`DELETE /v1/buckets/{bucket}/multipart-uploads/{upload_id}` → `void`

Path arguments, in order: `bucket`, `uploadId`.

### `storage()->completeMultipartUpload()`

Complete a multipart upload

`POST /v1/buckets/{bucket}/multipart-uploads/{upload_id}/complete` → `Result`

Path arguments, in order: `bucket`, `uploadId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `parts` (array, required): Every part the assembled object is made of, in ascending part_number order. Each etag must match the one that part's upload returned.

### `storage()->createBucket()`

Create bucket

`POST /v1/buckets` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `object_lock_enabled` (boolean): When true, enables S3 Object Lock on the bucket at creation time and turns versioning on. Object Lock cannot be enabled later.

### `storage()->createSnapshot()`

Create snapshot

`POST /v1/snapshots` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `volume` (string, required): Account-owned volume UUID, CRN, or exact name.
- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 

### `storage()->createSnapshotPolicy()`

Create snapshot policy

`POST /v1/snapshot-policies` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `volume` (string, required): Account-owned volume UUID, CRN, or exact name.
- `name` (string, required): Unique within the account — it names the policy in its CRN. Scheduled snapshots are named `<policy>-<UTC timestamp>`. Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `interval_minutes` (integer, required): Minutes between snapshots — a minimum gap, not an exact cadence. A periodic pass takes whatever has come due and re-bases each policy's next run off the moment it ran, so a snapshot lands at or after `interval_minutes` and never before, and can land a minute or two later when the pass is busy. A window the pass misses costs one snapshot rather than producing a catch-up burst afterwards. The floor is one minute, because that pass is what evaluates the schedule and nothing finer can be honoured; the ceiling is 30 days. Sub-hourly intervals multiply snapshot churn and count against the `snapshots` quota, so pick the largest interval that meets your recovery point objective.
- `retention_count` (integer, required): How many of this policy's snapshots to keep. When a fire takes the count past this, the oldest go first.
- `retention_days` (integer): Optional age bound, applied on top of `retention_count`: a snapshot outside EITHER window is reaped. 0 means no age bound. The single newest snapshot is exempt from the age bound, so a volume that could not be snapshotted for longer than the window never loses its whole history.
- `enabled` (boolean): Defaults to true. Set false to attach a paused schedule. Pausing stops the whole policy — no snapshots are taken and none are deleted, because a paused schedule that kept reaping would delete history while you were looking at it.
- `tags` (object): 

### `storage()->createVolume()`

Create volume

`POST /v1/volumes` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `performance` (object): Independently provision total sustained, combined read/write performance. Omitted dimensions retain their current value (included allowance on create). SSD permits up to 8000 IOPS and 250 MiB/s; NVMe up to 12000 and 500 MiB/s. The minimum is the volume's included allowance; higher grandfathered allowances remain available free of charge. Throughput is whole MiB/s, except an exact fractional legacy allowance may be selected to remove the paid add-on. Increases require account quota, regional capacity, and healthy storage. Applied extras bill by elapsed duration, including while detached or stopped.
- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 
- `volume_type` (string, required): The tiers a new volume may be provisioned on. `hdd` is a valid stored tier but its pool is reserved for cold storage, so creating a block volume on it is rejected.
- `size_gb` (integer, required): 
- `architecture` (string): Architecture used for source_image name resolution. A full image CRN pins its own architecture.
- `source_image` (string): Image UUID, name, name:version, or full CRN image/<name>/architecture/<arch>/version/<version>. Names resolve in the caller account first, then tagged platform catalog images, using architecture (default amd64). Mutually exclusive with source_snapshot. Image tags are not accepted.
- `source_snapshot` (string): Clone from an available account-owned snapshot UUID or nested CRN volume/<volume-name>/snapshot/<snapshot-name>. Bare snapshot names are rejected because this request has no fixed source volume. Mutually exclusive with source_image; size_gb must be at least the snapshot's frozen size.
- `bootable` (boolean): 

### `storage()->deleteBucket()`

Delete bucket

`DELETE /v1/buckets/{bucket}` → `Result`

Path arguments, in order: `bucket`.

### `storage()->deleteBucketCORS()`

Delete bucket CORS configuration

`DELETE /v1/buckets/{bucket}/cors` → `void`

Path arguments, in order: `bucket`.

### `storage()->deleteBucketEncryption()`

Delete bucket encryption configuration

`DELETE /v1/buckets/{bucket}/encryption` → `void`

Path arguments, in order: `bucket`.

### `storage()->deleteBucketLifecycle()`

Delete bucket lifecycle configuration

`DELETE /v1/buckets/{bucket}/lifecycle` → `void`

Path arguments, in order: `bucket`.

Headers (RequestOptions) fields:

- `If-Match` (string, required): Exact quoted revision from GET. Wildcards and weak entity tags are not accepted.

### `storage()->deleteBucketObjectLock()`

Delete bucket object-lock configuration

`DELETE /v1/buckets/{bucket}/object-lock` → `void`

Path arguments, in order: `bucket`.

### `storage()->deleteBucketPolicy()`

Delete bucket policy

`DELETE /v1/buckets/{bucket}/policy` → `void`

Path arguments, in order: `bucket`.

### `storage()->deleteBucketTagging()`

Delete bucket tag set

`DELETE /v1/buckets/{bucket}/tagging` → `void`

Path arguments, in order: `bucket`.

### `storage()->deleteObject()`

Delete object

`DELETE /v1/buckets/{bucket}/objects/{key}` → `void`

Path arguments, in order: `bucket`, `key`.

### `storage()->deleteSnapshot()`

Delete snapshot

`DELETE /v1/snapshots/{snapshot_id}` → `void`

Path arguments, in order: `snapshotId`.

### `storage()->deleteSnapshotPolicy()`

Delete snapshot policy

`DELETE /v1/snapshot-policies/{policy_id}` → `void`

Path arguments, in order: `policyId`.

### `storage()->deleteVolume()`

Delete volume

`DELETE /v1/volumes/{volume_id}` → `void`

Path arguments, in order: `volumeId`.

### `storage()->extendVolume()`

Extend volume

`POST /v1/volumes/{volume_id}/extend` → `Result`

Path arguments, in order: `volumeId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `new_size_gb` (integer, required): New size in GB. Must be strictly greater than the current size.

### `storage()->getBucketCORS()`

Get bucket CORS configuration

`GET /v1/buckets/{bucket}/cors` → `Result`

Path arguments, in order: `bucket`.

### `storage()->getBucketEncryption()`

Get bucket encryption configuration

`GET /v1/buckets/{bucket}/encryption` → `Result`

Path arguments, in order: `bucket`.

### `storage()->getBucketLifecycle()`

Get bucket lifecycle configuration

`GET /v1/buckets/{bucket}/lifecycle` → `Result`

Path arguments, in order: `bucket`.

### `storage()->getBucketObjectLock()`

Get bucket object-lock configuration

`GET /v1/buckets/{bucket}/object-lock` → `Result`

Path arguments, in order: `bucket`.

### `storage()->getBucketPolicy()`

Get bucket policy

`GET /v1/buckets/{bucket}/policy` → `Result`

Path arguments, in order: `bucket`.

### `storage()->getBucketTagging()`

Get bucket tag set

`GET /v1/buckets/{bucket}/tagging` → `Result`

Path arguments, in order: `bucket`.

### `storage()->getBucketVersioning()`

Get bucket versioning state

`GET /v1/buckets/{bucket}/versioning` → `Result`

Path arguments, in order: `bucket`.

### `storage()->getObject()`

Download object

`GET /v1/buckets/{bucket}/objects/{key}` → `Result`

Path arguments, in order: `bucket`, `key`.

`getSnapshotByReference(...)` resolves an ID, CRN, or scoped name.

### `storage()->getSnapshot()`

Get snapshot

`GET /v1/snapshots/{snapshot_id}` → `Result`

Path arguments, in order: `snapshotId`.

`getSnapshotPolicyByReference(...)` resolves an ID, CRN, or scoped name.

### `storage()->getSnapshotPolicy()`

Get snapshot policy

`GET /v1/snapshot-policies/{policy_id}` → `Result`

Path arguments, in order: `policyId`.

`getVolumeByReference(...)` resolves an ID, CRN, or scoped name.

### `storage()->getVolume()`

Get volume

`GET /v1/volumes/{volume_id}` → `Result`

Path arguments, in order: `volumeId`.

### `storage()->headBucket()`

Head bucket

`HEAD /v1/buckets/{bucket}` → `void`

Path arguments, in order: `bucket`.

### `storage()->headObject()`

Head object

`HEAD /v1/buckets/{bucket}/objects/{key}` → `void`

Path arguments, in order: `bucket`, `key`.

### `storage()->initiateMultipartUpload()`

Initiate a multipart upload

`POST /v1/buckets/{bucket}/multipart-uploads` → `Result`

Path arguments, in order: `bucket`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `key` (string, required): 
- `content_type` (string): 
- `storage_class` (string): 
- `metadata` (object): 

### `storage()->listBuckets()`

List buckets

`GET /v1/buckets` → `Page`

Query fields:

- `limit` (integer): 
- `marker` (string): Resume token — the last bucket name from the previous page.
- `name` (string): Exact account-scoped bucket name; an empty value matches nothing.
- `crn` (string): Exact CRN filter. Malformed CRNs return 400; foreign accounts, regions or resource types return an empty page. Intersects all other filters.

### `storage()->listMultipartUploads()`

List in-flight multipart uploads

`GET /v1/buckets/{bucket}/multipart-uploads` → `Page`

Path arguments, in order: `bucket`.

Query fields:

- `prefix` (string): 
- `max_uploads` (integer): 

### `storage()->listObjectVersions()`

List object versions

`GET /v1/buckets/{bucket}/object-versions` → `Page`

Path arguments, in order: `bucket`.

Query fields:

- `prefix` (string): 
- `key_marker` (string): 
- `version_id_marker` (string): 
- `max_keys` (integer): 

### `storage()->listObjects()`

List objects

`GET /v1/buckets/{bucket}/objects` → `Result`

Path arguments, in order: `bucket`.

Query fields:

- `prefix` (string): 
- `delimiter` (string): 
- `marker` (string): 
- `max_keys` (integer): 

### `storage()->listParts()`

List uploaded parts

`GET /v1/buckets/{bucket}/multipart-uploads/{upload_id}/parts` → `Page`

Path arguments, in order: `bucket`, `uploadId`.

### `storage()->listSnapshotPolicies()`

List snapshot policies

`GET /v1/snapshot-policies` → `Page`

Query fields:

- `limit` (integer): 
- `marker` (string): Resume token — the last policy id from the previous page.
- `volume` (string): Account-owned volume UUID, CRN, or exact name. Narrows to the policy attached to that volume.
- `enabled` (boolean): Narrow to enabled (or paused) policies.
- `name` (string): Exact account-scoped name match; an empty value matches nothing.
- `crn` (string): Exact CRN filter. Malformed CRNs return 400; foreign accounts, regions or resource types return an empty page. Intersects all other filters.

### `storage()->listSnapshots()`

List snapshots

`GET /v1/snapshots` → `Page`

Query fields:

- `limit` (integer): 
- `marker` (string): Resume token — the last snapshot id from the previous page.
- `volume` (string): Account-owned volume UUID, CRN, or exact name.
- `name` (string): Exact snapshot name within an explicitly supplied volume filter; missing volume returns 400.
- `status` (string): 
- `crn` (string): Exact CRN filter. Malformed CRNs return 400; foreign accounts, regions or resource types return an empty page. Intersects all other filters.
- `snapshot_policy` (string): Account-owned snapshot policy UUID, CRN, or exact name.

### `storage()->listVolumeTypes()`

List volume types

`GET /v1/volume-types` → `Page`

Query fields:

- `name` (string): Exact display name, case-sensitive; an empty value matches nothing.
- `crn` (string): Exact regional platform volume-type CRN. Foreign or mismatched identities return an empty list.

### `storage()->listVolumes()`

List volumes

`GET /v1/volumes` → `Page`

Query fields:

- `limit` (integer): 
- `marker` (string): Resume token — the last volume id from the previous page.
- `name` (string): Exact account-scoped name match; an empty value matches nothing.
- `status` (string): 
- `crn` (string): Exact CRN filter. Malformed CRNs return 400; foreign accounts, regions or resource types return an empty page. Intersects all other filters.

### `storage()->putBucketCORS()`

Put bucket CORS configuration

`PUT /v1/buckets/{bucket}/cors` → `void`

Path arguments, in order: `bucket`.

Body fields:

- `cors` (object, required): 

### `storage()->putBucketDeletionProtection()`

Set bucket deletion protection

`PUT /v1/buckets/{bucket}/deletion-protection` → `void`

Path arguments, in order: `bucket`.

Body fields:

- `enabled` (boolean, required): When true, DeleteBucket schedules deletion instead of removing immediately.
- `recovery_window_days` (integer): Whole days; omitted defaults to 7. Explicit values outside 1–30 return 400 even when disabling protection.

### `storage()->putBucketEncryption()`

Put bucket encryption configuration

`PUT /v1/buckets/{bucket}/encryption` → `void`

Path arguments, in order: `bucket`.

Body fields:

- `encryption` (object, required): 

### `storage()->putBucketLifecycle()`

Put bucket lifecycle configuration

`PUT /v1/buckets/{bucket}/lifecycle` → `void`

Path arguments, in order: `bucket`.

Headers (RequestOptions) fields:

- `If-Match` (string, required): Exact quoted revision from GET. Wildcards and weak entity tags are not accepted.

Body fields:

- `lifecycle` (object, required): 

### `storage()->putBucketObjectLock()`

Put bucket object-lock configuration

`PUT /v1/buckets/{bucket}/object-lock` → `void`

Path arguments, in order: `bucket`.

Body fields:

- `object_lock` (object, required): 

### `storage()->putBucketPolicy()`

Put bucket policy

`PUT /v1/buckets/{bucket}/policy` → `void`

Path arguments, in order: `bucket`.

Body fields:

- `document` (object, required): pkg/policy.PolicyDocument serialization. See the IAM policy docs for the statement shape; here we just declare it as an opaque object so the spec doesn't have to track schema changes inside the policy engine.

### `storage()->putBucketTagging()`

Put bucket tag set

`PUT /v1/buckets/{bucket}/tagging` → `void`

Path arguments, in order: `bucket`.

Body fields:

- `tags` (object, required): 

### `storage()->putBucketVersioning()`

Set bucket versioning state

`PUT /v1/buckets/{bucket}/versioning` → `void`

Path arguments, in order: `bucket`.

Body fields:

- `status` (string, required): 

### `storage()->putObject()`

Upload object

`PUT /v1/buckets/{bucket}/objects/{key}` → `Result`

Path arguments, in order: `bucket`, `key`.

### `storage()->restoreBucket()`

Restore a bucket pending deletion

`POST /v1/buckets/{bucket}/restore` → `void`

Path arguments, in order: `bucket`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

### `storage()->updateSnapshot()`

Update snapshot metadata

`PATCH /v1/snapshots/{snapshot_id}` → `Result`

Path arguments, in order: `snapshotId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `storage()->updateSnapshotPolicy()`

Update snapshot policy

`PATCH /v1/snapshot-policies/{policy_id}` → `Result`

Path arguments, in order: `policyId`.

Body fields:

- `description` (string): 
- `enabled` (boolean): false pauses the policy, true resumes it. Pausing stops the whole policy — no snapshots are taken and none are deleted, so a paused schedule cannot lose you history. Resuming applies the retention window again on the next run, so anything sitting outside it by then — because you lowered `retention_count` while paused, say — is reaped on that run.
- `interval_minutes` (integer): Minutes between snapshots — a minimum gap, not an exact cadence. A periodic pass takes whatever has come due and re-bases each policy's next run off the moment it ran, so a snapshot lands at or after `interval_minutes` and never before, and can land a minute or two later when the pass is busy. A window the pass misses costs one snapshot rather than producing a catch-up burst afterwards. The floor is one minute, because that pass is what evaluates the schedule and nothing finer can be honoured; the ceiling is 30 days. Sub-hourly intervals multiply snapshot churn and count against the `snapshots` quota, so pick the largest interval that meets your recovery point objective.
- `retention_count` (integer): How many of this policy's snapshots to keep. When a fire takes the count past this, the oldest go first.
- `retention_days` (integer): Optional age bound, applied on top of `retention_count`: a snapshot outside EITHER window is reaped. 0 means no age bound. The single newest snapshot is exempt from the age bound, so a volume that could not be snapshotted for longer than the window never loses its whole history.
- `tags` (object): 

### `storage()->updateVolume()`

Update volume metadata

`PATCH /v1/volumes/{volume_id}` → `Result`

Path arguments, in order: `volumeId`.

Body fields:

- `description` (string): 
- `tags` (object): 

### `storage()->updateVolumePerformance()`

Update provisioned performance

`POST /v1/volumes/{volume_id}/performance` → `Result`

Path arguments, in order: `volumeId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `iops` (integer): 
- `throughput_mib_s` (number): 

### `storage()->uploadPart()`

Upload a part

`PUT /v1/buckets/{bucket}/multipart-uploads/{upload_id}/parts/{part_number}` → `Result`

Path arguments, in order: `bucket`, `uploadId`, `partNumber`.

## Telemetry

### `telemetry()->createLogGroup()`

Create a log group

`POST /v1/log-groups` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `retention_days` (integer): 1..3650, or omit for never expire
- `kms_key` (string): KMS key UUID, CRN or exact name in the authenticated account and serving region. The resolved UUID is pinned; deleting a key and reusing its name never retargets existing data. An empty string selects plaintext.
- `tags` (object): 

### `telemetry()->deleteLogGroup()`

Delete a log group

`DELETE /v1/log-groups/{id}` → `void`

Path arguments, in order: `id`.

### `telemetry()->deleteTraceSettings()`

Delete trace settings

`DELETE /v1/trace-settings` → `void`

### `telemetry()->getLog()`

Get a single log record by id

`GET /v1/logs/{log_id}` → `Result`

Path arguments, in order: `logId`.

`getLogGroupByReference(...)` resolves an ID, CRN, or scoped name.

### `telemetry()->getLogGroup()`

Get a log group by id

`GET /v1/log-groups/{id}` → `Result`

Path arguments, in order: `id`.

### `telemetry()->getRetainedTelemetryPresence()`

Check retained telemetry presence

`GET /v1/trace-settings/retained-data` → `Result`

### `telemetry()->getTrace()`

Get all spans for a trace

`GET /v1/traces/{trace_id}` → `Result`

Path arguments, in order: `traceId`.

### `telemetry()->getTraceSettings()`

Get the caller account's trace settings

`GET /v1/trace-settings` → `Result`

### `telemetry()->ingestLogs()`

Ingest a batch of log records

`POST /v1/logs` → `Result`

Body fields:

- `logs` (array, required): 

### `telemetry()->ingestSpans()`

Ingest a batch of trace spans

`POST /v1/spans` → `Result`

Body fields:

- `spans` (array, required): 

### `telemetry()->listLogGroups()`

List log groups (or look up one by name)

`GET /v1/log-groups` → `Page`

Query fields:

- `name` (string): Exact name filter, intersected with crn and pagination.
- `crn` (string): Exact telemetry/log-group CRN filter in the authenticated account and serving region. Malformed or empty CRNs return 400. Valid foreign or mismatched CRNs return an empty page. Intersected with name and pagination.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `telemetry()->listMetricNames()`

List the distinct metric names emitted in a time window

`GET /v1/metrics/names` → `Page`

Query fields:

- `start` (string, required): 
- `end` (string, required): 

### `telemetry()->listMetricNamesPost()`

List the distinct metric names emitted in a time window (form body)

`POST /v1/metrics/names` → `Result`

Body fields:

- `start` (string, required): 
- `end` (string, required): 

### `telemetry()->listMetricSeries()`

List distinct label sets for a metric

`GET /v1/metrics/series` → `Result`

Query fields:

- `metric` (string, required): 
- `start` (string, required): 
- `end` (string, required): 

### `telemetry()->listMetricSeriesPost()`

List distinct label sets for a metric (form body)

`POST /v1/metrics/series` → `Result`

Body fields:

- `metric` (string, required): 
- `start` (string, required): 
- `end` (string, required): 

### `telemetry()->putTraceSettings()`

Update the caller account's trace settings

`PUT /v1/trace-settings` → `Result`

Body fields:

- `retention_days` (integer): 1..3650; pass clear_retention=true to switch to never-expire
- `clear_retention` (boolean): When true, sets retention to never-expire (ignores retention_days)
- `kms_key` (string): KMS key UUID, CRN or exact name in the authenticated account and serving region. PUT replaces settings; omission or an empty string selects plaintext for future spans. Historical ciphertext retains its original key UUID.

### `telemetry()->queryMetricsInstant()`

Instant structured metric query

`GET /v1/metrics/query` → `Result`

Query fields:

- `metric` (string, required): Metric name
- `agg` (string, required): Aggregation
- `match[]` (array): Label matchers (e.g. job="api")
- `by[]` (array): Group-by label names
- `step` (string): Lookback window duration (e.g. "15s", "5m"). Defaults to 5m.
- `time` (string): Evaluation timestamp (RFC 3339 or unix seconds). Defaults to now.

### `telemetry()->queryMetricsInstantPost()`

Instant structured metric query (form body)

`POST /v1/metrics/query` → `Result`

Body fields:

- `metric` (string, required): 
- `agg` (string, required): 
- `match[]` (array): 
- `by[]` (array): 
- `step` (string): 
- `time` (string): 

### `telemetry()->queryMetricsRange()`

Range structured metric query

`GET /v1/metrics/query_range` → `Result`

Query fields:

- `metric` (string, required): 
- `agg` (string, required): 
- `match[]` (array): 
- `by[]` (array): 
- `start` (string, required): 
- `end` (string, required): 
- `step` (string): Bucket width duration (e.g. "15s", "1m")

### `telemetry()->queryMetricsRangePost()`

Range structured metric query (form body)

`POST /v1/metrics/query_range` → `Result`

Body fields:

- `metric` (string, required): 
- `agg` (string, required): 
- `match[]` (array): 
- `by[]` (array): 
- `start` (string, required): 
- `end` (string, required): 
- `step` (string): 

### `telemetry()->searchLogs()`

Search log records

`GET /v1/logs` → `Result`

Query fields:

- `from` (string, required): Lower bound on timestamp (inclusive)
- `to` (string, required): Upper bound on timestamp (exclusive); must be after from and within 31d
- `log_group` (string): Filter by log-group UUID, CRN or exact name in the authenticated account. CRNs must match the serving region and account handle; invalid references never fall back to names.
- `log_stream` (string): Filter by stream name within the group
- `min_severity` (string): Filter to records with severity >= this band
- `region` (string): Filter by emitter region
- `q` (string): Case-insensitive substring on the log body
- `trace_id` (string): Filter to records carrying this W3C trace id
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `telemetry()->searchTraces()`

List traces

`GET /v1/traces` → `Result`

Query fields:

- `from` (string, required): Lower bound on span start_time (inclusive)
- `to` (string, required): Upper bound on span start_time (exclusive); must be after from and within 31d
- `service` (string): Filter by service.name
- `operation` (string): Filter by span name (operation)
- `status_code` (string): Filter by status code
- `min_duration_ms` (number): Filter to traces whose end-to-end duration is at least this many ms
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `telemetry()->updateLogGroup()`

Update a log group

`PATCH /v1/log-groups/{id}` → `Result`

Path arguments, in order: `id`.

Body fields:

- `description` (string): 
- `retention_days` (integer): 1..3650; pass clear_retention to switch to never expire
- `clear_retention` (boolean): When true, sets retention to never-expire (ignores retention_days)
- `kms_key` (string): KMS key UUID, CRN or exact name in the authenticated account and serving region. Omission preserves the pinned UUID; an empty string clears encryption for future records. Unavailable key metadata does not clear the binding.
- `tags` (object): 

### `telemetry()->writeMetrics()`

Prometheus remote_write ingest

`POST /v1/metrics/write` → `void`

## Workspace

### `workspace()->addUser()`

Add user to organization

`POST /v1/users` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `email` (string, required): Email of the user to add
- `tags` (object): 
- `groups` (array): Groups to assign when the invitation is accepted. Each reference is validated in the caller organization before the invitation is created.

### `workspace()->addUserToGroup()`

Add user to group

`POST /v1/users/{user_id}/groups` → `void`

Path arguments, in order: `userId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `group` (string, required): Group UUID, immutable name in the authenticated organization, or a Workspace CRN in the authenticated organization. Groups contain users only.

### `workspace()->assignAccountRole()`

Assign account role

`POST /v1/accounts/{account_id}/role-assignments` → `Result`

Path arguments, in order: `accountId`.

Body fields:

- `principal_type` (string, required): 
- `principal_id` (string, required): Immutable UUID of a user or users-only group in this organization.
- `role_id` (string, required): Immutable UUID of a role owned by the target account.

### `workspace()->attachGroupPolicy()`

Attach policy to group

`POST /v1/groups/{group_id}/policies` → `void`

Path arguments, in order: `groupId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `policy` (string, required): Organization policy UUID, immutable name in the authenticated organization, or fully qualified Workspace CRN. Shared system policies use crn:workspace:::system-policy/<name>. Account IAM policies cannot be attached through Workspace.

### `workspace()->attachRolePolicy()`

Attach policy to role

`POST /v1/roles/{role_id}/policies` → `void`

Path arguments, in order: `roleId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `policy_id` (string, required): Immutable UUID of the organization policy to attach.

### `workspace()->attachServiceAccountPolicy()`

Attach policy to service account

`POST /v1/service-accounts/{service_account_id}/policies` → `void`

Path arguments, in order: `serviceAccountId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `policy_id` (string, required): Immutable UUID of the organization policy to attach.

### `workspace()->attachUserPolicy()`

Attach policy to user

`POST /v1/users/{user_id}/policies` → `void`

Path arguments, in order: `userId`.

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `policy` (string, required): Organization policy UUID, immutable name in the authenticated organization, or fully qualified Workspace CRN. Shared system policies use crn:workspace:::system-policy/<name>. Account IAM policies cannot be attached through Workspace.

### `workspace()->cancelInvitation()`

Cancel invitation

`DELETE /v1/invitations/{invitation_id}` → `void`

Path arguments, in order: `invitationId`.

### `workspace()->createAccount()`

Create account

`POST /v1/accounts` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): 
- `handle` (string, required): 
- `description` (string): 

### `workspace()->createGroup()`

Create group

`POST /v1/groups` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 

### `workspace()->createPolicy()`

Create policy

`POST /v1/policies` → `Result`

Headers (RequestOptions) fields:

- `Idempotency-Key` (string): Optional client-generated key that makes a create replay-safe. Retrying a request with the same key returns the original outcome verbatim instead of creating a duplicate resource. Reusing a key with a different request body is rejected (422); a request whose key is still being processed returns 409. Records are honored for 24 hours. Use a UUID or similarly unique token.

Body fields:

- `name` (string, required): Resource names must not start with the literal crn: prefix or be UUIDs (canonical, compact, braced, or urn:uuid: forms, in either case).
- `description` (string): 
- `tags` (object): 
- `document` (object, required): IAM-style policy document

### `workspace()->deleteAccount()`

Delete account

`DELETE /v1/accounts/{account_id}` → `void`

Path arguments, in order: `accountId`.

### `workspace()->deleteGroup()`

Delete group

`DELETE /v1/groups/{group_id}` → `void`

Path arguments, in order: `groupId`.

### `workspace()->deleteGroupInlinePolicy()`

Delete a group's inline policy by name

`DELETE /v1/groups/{group_id}/inline-policies/{policy_name}` → `void`

Path arguments, in order: `groupId`, `policyName`.

### `workspace()->deleteOrganization()`

Delete organization

`DELETE /v1/organizations/{organization_id}` → `void`

Path arguments, in order: `organizationId`.

### `workspace()->deletePolicy()`

Delete policy

`DELETE /v1/policies/{policy_id}` → `void`

Path arguments, in order: `policyId`.

### `workspace()->deleteUserInlinePolicy()`

Delete a user's inline policy by name

`DELETE /v1/users/{user_id}/inline-policies/{policy_name}` → `void`

Path arguments, in order: `userId`, `policyName`.

### `workspace()->detachGroupPolicy()`

Detach policy from group

`DELETE /v1/groups/{group_id}/policies/{policy_id}` → `void`

Path arguments, in order: `groupId`, `policyId`.

### `workspace()->detachRolePolicy()`

Detach policy from role

`DELETE /v1/roles/{role_id}/policies/{policy_id}` → `void`

Path arguments, in order: `roleId`, `policyId`.

### `workspace()->detachServiceAccountPolicy()`

Detach policy from service account

`DELETE /v1/service-accounts/{service_account_id}/policies/{policy_id}` → `void`

Path arguments, in order: `serviceAccountId`, `policyId`.

### `workspace()->detachUserPolicy()`

Detach policy from user

`DELETE /v1/users/{user_id}/policies/{policy_id}` → `void`

Path arguments, in order: `userId`, `policyId`.

`getAccountByReference(...)` resolves an ID, CRN, or scoped name.

### `workspace()->getAccount()`

Get account

`GET /v1/accounts/{account_id}` → `Result`

Path arguments, in order: `accountId`.

### `workspace()->getAccountResources()`

Check account resource presence

`GET /v1/accounts/{account_id}/resources` → `Result`

Path arguments, in order: `accountId`.

`getGroupByReference(...)` resolves an ID, CRN, or scoped name.

### `workspace()->getGroup()`

Get group

`GET /v1/groups/{group_id}` → `Result`

Path arguments, in order: `groupId`.

`getGroupInlinePolicyByReference(...)` resolves an ID, CRN, or scoped name.

### `workspace()->getGroupInlinePolicy()`

Get a group's inline policy by name

`GET /v1/groups/{group_id}/inline-policies/{policy_name}` → `Result`

Path arguments, in order: `groupId`, `policyName`.

`getInvitationByReference(...)` resolves an ID, CRN, or scoped name.

### `workspace()->getInvitation()`

Get invitation

`GET /v1/invitations/{invitation_id}` → `Result`

Path arguments, in order: `invitationId`.

`getOrganizationByReference(...)` resolves an ID, CRN, or scoped name.

### `workspace()->getOrganization()`

Get organization

`GET /v1/organizations/{organization_id}` → `Result`

Path arguments, in order: `organizationId`.

`getPolicyByReference(...)` resolves an ID, CRN, or scoped name.

### `workspace()->getPolicy()`

Get policy

`GET /v1/policies/{policy_id}` → `Result`

Path arguments, in order: `policyId`.

`getUserByReference(...)` resolves an ID, CRN, or scoped name.

### `workspace()->getUser()`

Get user

`GET /v1/users/{user_id}` → `Result`

Path arguments, in order: `userId`.

`getUserInlinePolicyByReference(...)` resolves an ID, CRN, or scoped name.

### `workspace()->getUserInlinePolicy()`

Get a user's inline policy by name

`GET /v1/users/{user_id}/inline-policies/{policy_name}` → `Result`

Path arguments, in order: `userId`, `policyName`.

### `workspace()->getUserPermissionBoundary()`

Get a user's permission boundary

`GET /v1/users/{user_id}/permission-boundary` → `Result`

Path arguments, in order: `userId`.

### `workspace()->listAccountRoleAssignments()`

List account role assignments

`GET /v1/accounts/{account_id}/role-assignments` → `Page`

Path arguments, in order: `accountId`.

### `workspace()->listAccountRoles()`

List assigned account roles

`GET /v1/account-roles` → `Page`

### `workspace()->listAccounts()`

List accounts

`GET /v1/accounts` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listGroupInlinePolicies()`

List a group's inline policies

`GET /v1/groups/{group_id}/inline-policies` → `Page`

Path arguments, in order: `groupId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `workspace()->listGroupPolicies()`

List group policies

`GET /v1/groups/{group_id}/policies` → `Page`

Path arguments, in order: `groupId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `workspace()->listGroupUsers()`

List group users

`GET /v1/groups/{group_id}/users` → `Page`

Path arguments, in order: `groupId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listGroups()`

List groups

`GET /v1/groups` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listInvitations()`

List invitations

`GET /v1/invitations` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listOrganizations()`

List organizations

`GET /v1/organizations` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listPolicies()`

List policies

`GET /v1/policies` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listPolicyGroups()`

List groups with policy

`GET /v1/policies/{policy_id}/groups` → `Page`

Path arguments, in order: `policyId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listPolicyRoles()`

List roles with policy

`GET /v1/policies/{policy_id}/roles` → `Page`

Path arguments, in order: `policyId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listPolicyServiceAccounts()`

List service accounts with policy

`GET /v1/policies/{policy_id}/service-accounts` → `Page`

Path arguments, in order: `policyId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listPolicyUsers()`

List users with policy

`GET /v1/policies/{policy_id}/users` → `Page`

Path arguments, in order: `policyId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->listRolePolicies()`

List role policies

`GET /v1/roles/{role_id}/policies` → `Page`

Path arguments, in order: `roleId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `workspace()->listServiceAccountPolicies()`

List service account policies

`GET /v1/service-accounts/{service_account_id}/policies` → `Page`

Path arguments, in order: `serviceAccountId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `workspace()->listUserGroups()`

List user groups

`GET /v1/users/{user_id}/groups` → `Page`

Path arguments, in order: `userId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `workspace()->listUserInlinePolicies()`

List a user's inline policies

`GET /v1/users/{user_id}/inline-policies` → `Page`

Path arguments, in order: `userId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `workspace()->listUserPolicies()`

List user policies

`GET /v1/users/{user_id}/policies` → `Page`

Path arguments, in order: `userId`.

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.

### `workspace()->listUsers()`

List users

`GET /v1/users` → `Page`

Query fields:

- `name` (string): Exact resource name, combined with crn using AND before pagination. Empty values are filters. Resources without a name never match.
- `crn` (string): Exact returned CRN, combined with name using AND before pagination. Malformed or empty CRNs return 400; valid mismatched or foreign CRNs return an empty page. Resources without a CRN never match. Organization-scoped CRNs use the authenticated organization.
- `limit` (integer): Maximum number of items to return. A value above the maximum is clamped to it rather than rejected, so a page shorter than the one you asked for is normal — page until `meta.has_more` is false, not until a page looks short.
- `marker` (string): Opaque pagination cursor. Echo back the `meta.marker` value from the previous page to fetch the next one; do not construct or parse it. The token's internal form varies by endpoint (a resource ID, a timestamp, …) and is not guaranteed stable across releases.

### `workspace()->putGroupInlinePolicy()`

Create or replace a group's inline policy

`PUT /v1/groups/{group_id}/inline-policies/{policy_name}` → `Result`

Path arguments, in order: `groupId`, `policyName`.

Body fields:

- `document` (object, required): IAM-style policy document

### `workspace()->putUserInlinePolicy()`

Create or replace a user's inline policy

`PUT /v1/users/{user_id}/inline-policies/{policy_name}` → `Result`

Path arguments, in order: `userId`, `policyName`.

Body fields:

- `document` (object, required): IAM-style policy document

### `workspace()->removeAccountRoleAssignment()`

Remove account role assignment

`DELETE /v1/accounts/{account_id}/role-assignments/{assignment_id}` → `void`

Path arguments, in order: `accountId`, `assignmentId`.

### `workspace()->removeUser()`

Remove user from organization

`DELETE /v1/users/{user_id}` → `void`

Path arguments, in order: `userId`.

### `workspace()->removeUserFromGroup()`

Remove user from group

`DELETE /v1/users/{user_id}/groups/{group_id}` → `void`

Path arguments, in order: `userId`, `groupId`.

### `workspace()->removeUserPermissionBoundary()`

Remove a user's permission boundary

`DELETE /v1/users/{user_id}/permission-boundary` → `void`

Path arguments, in order: `userId`.

### `workspace()->setUserPermissionBoundary()`

Set a user's permission boundary

`PUT /v1/users/{user_id}/permission-boundary` → `void`

Path arguments, in order: `userId`.

Body fields:

- `policy` (string, required): Organization policy UUID, immutable name in the authenticated organization, or fully qualified Workspace CRN. Shared system policies use crn:workspace:::system-policy/<name>. Account IAM policies cannot be attached through Workspace.

### `workspace()->updateAccount()`

Update account

`PATCH /v1/accounts/{account_id}` → `Result`

Path arguments, in order: `accountId`.

Body fields:

- `name` (string): 
- `description` (string): 

### `workspace()->updateGroup()`

Update group

`PATCH /v1/groups/{group_id}` → `Result`

Path arguments, in order: `groupId`.

Body fields:

- `description` (string): 

### `workspace()->updateOrganization()`

Update organization

`PATCH /v1/organizations/{organization_id}` → `Result`

Path arguments, in order: `organizationId`.

Body fields:

- `language` (string): Language for organization billing and operational emails, independent of each user's console preference.
- `time_zone` (string): IANA timezone for formatting organization emails. Does not change billing periods or resource schedules.
- `name` (string): 
- `description` (string): 
- `captcha_token` (string, required): Google reCAPTCHA token for bot protection

### `workspace()->updatePolicy()`

Update policy

`PATCH /v1/policies/{policy_id}` → `Result`

Path arguments, in order: `policyId`.

Body fields:

- `description` (string): 
- `tags` (object): 
- `document` (object): IAM-style policy document
