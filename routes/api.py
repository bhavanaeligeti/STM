import requests

def fetch_github_user(username):
    url = f"https://api.github.com/users/{username}"
    response = requests.get(url)

    if response.status_code == 200:
        user_data = response.json()
        return user_data
    else:
        print("Failed to fetch user data.")
        return None

def fetch_github_repositories(username):
    url = f"https://api.github.com/users/{username}/repos"
    response = requests.get(url)

    if response.status_code == 200:
        repositories_data = response.json()
        return repositories_data
    else:
        print("Failed to fetch repositories.")
        return None

if __name__ == "__main__":
    github_username = input("Enter a GitHub username: ")

    user_data = fetch_github_user(github_username)
    if user_data:
        print("\nGitHub User Data:")
        print("Username:", user_data['login'])
        print("Name:", user_data['name'])
        print("Followers:", user_data['followers'])
        print("Public Repositories:", user_data['public_repos'])

        repositories_data = fetch_github_repositories(github_username)
        if repositories_data:
            print("\nPublic Repositories:")
            for repo in repositories_data:
                print(f"Repository: {repo['name']}, URL: {repo['html_url']}")
