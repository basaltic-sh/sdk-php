# Changelog

## 0.7.1

- Choose the exact members to remove when reducing an instance pool with `scale_in_instances`.
- Protect or unprotect pool members with the pool member protection endpoint, and read protection and blocked scale-in status in pool responses.
- Include Email quota policies in quota responses.

Compatibility: `listQuotas` returns a `Result` containing both `quotas` and `policies`; it no longer returns a `Page`.
