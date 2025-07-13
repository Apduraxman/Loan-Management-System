## GitHub Copilot Chat

- Extension Version: 0.28.5 (prod)
- VS Code: vscode/1.101.2
- OS: Windows

## Network

User Settings:

```json
  "github.copilot.advanced.debug.useElectronFetcher": true,
  "github.copilot.advanced.debug.useNodeFetcher": false,
  "github.copilot.advanced.debug.useNodeFetchFetcher": true
```

Connecting to https://api.github.com:

- DNS ipv4 Lookup: 140.82.121.5 (4 ms)
- DNS ipv6 Lookup: Error (59 ms): getaddrinfo ENOTFOUND api.github.com
- Proxy URL: None (41 ms)
- Electron fetch (configured): HTTP 200 (281 ms)
- Node.js https: HTTP 200 (2130 ms)
- Node.js fetch: HTTP 200 (953 ms)
- Helix fetch: HTTP 200 (962 ms)

Connecting to https://api.individual.githubcopilot.com/_ping:

- DNS ipv4 Lookup: 140.82.114.22 (312 ms)
- DNS ipv6 Lookup: Error (741 ms): getaddrinfo ENOTFOUND api.individual.githubcopilot.com
- Proxy URL: None (26 ms)
- Electron fetch (configured): HTTP 200 (968 ms)
- Node.js https: HTTP 200 (660 ms)
- Node.js fetch: HTTP 200 (1053 ms)
- Helix fetch: HTTP 200 (950 ms)

## Documentation

In corporate networks: [Troubleshooting firewall settings for GitHub Copilot](https://docs.github.com/en/copilot/troubleshooting-github-copilot/troubleshooting-firewall-settings-for-github-copilot).
