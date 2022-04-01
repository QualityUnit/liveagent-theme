# Contributing to LiveAgent's WordPress Theme

Hi! Thank you for your interest in contributing to LiveAgent's WordPress Theme, we really appreciate it.

There are many ways to contribute – reporting bugs, feature suggestions and fixing bugs.

## Reporting Bugs, Asking Questions, Sending Suggestions

Just [file a GitHub issue](https://github.com/QualityUnit/liveagent-theme/issues/), that’s all. If you want to prefix the title with a “Question:”, “Bug:”, or the general area of the application, that would be helpful, but it is by no means mandatory. If you have write access, add the appropriate labels.

If you’re filing a bug, specific steps to reproduce are helpful. Please include the URL of the page that has the bug, along with what you expected to see and what happened instead.

## Installing LiveAgent's WordPress Theme Locally

If you’d like to contribute code, first, you will need to run the project locally. Here is the short version:

1. Make sure you have [`git`](https://git-scm.com/), [`node`](https://nodejs.org/), [`yarn`](https://classic.yarnpkg.com/en/docs/install), [`php`](https://www.php.net) and [`composer`](https://getcomposer.org) installed. Also, you need a local server with [`wordpress`](https://wordpress.org) installed.
2. Clone this repository locally.
3. Execute `yarn`, `composer install` and then `yarn dev` from the repository's root directory.
4. Open [`localhost:3000`](http://localhost:3000/) in your browser.

## Development Workflow

Running `yarn dev` will build all the code and continuously watch the front-end JS and SCSS for changes and rebuild accordingly.

## Pull Requests

### Code Reviews

Code reviews are an important part of the project workflow. They help to keep code quality consistent, and they help every person working on the project learn and improve over time. We want to make you the best project contributor you can be.

Every pull request should be reviewed and approved by someone other than the author, even if the author has write access. Fresh eyes can find problems that can hide in the open if you’ve been working on the code for a while.

The recommended way of finding an appropriate person to review your code is by [blaming](https://help.github.com/articles/using-git-blame-to-trace-changes-in-a-file/) one of the files you are updating and looking at who was responsible for previous commits on that file.

Then, you may ask that person to review your code by mentioning their GitHub username on the PR comments like this:

```
 cc @username
```

_Everyone_ is encouraged to review PRs and add feedback and ask questions, even people who are new to the project. Also, don’t just review PRs about what you’re working on. Reading other people’s code is a great way to learn new techniques, and seeing code outside of your own feature helps you to see patterns across the project. It’s also helpful to see the feedback other contributors are getting on their PRs.

### Coding Standards & Guidelines

We follow WordPress coding standards guidelines.

### Lifecycle of a Pull Request

When you’re first starting out, your natural instinct when creating a new feature will be to create a local feature branch, and start building away. If you start doing this, _stop_, take your hands off the keyboard, grab a coffee and read on. :)

**It’s important to break your feature down into small pieces first**, each piece should become its own pull request.

If you feel yourself waiting for someone to review a PR, don’t hesitate to personally ask for someone to review it or to mention them on GitHub. _The PR author is responsible for pushing the change through._

## License

LiveAgent's WordPress Theme is licensed under [GNU General Public License v2 (or later)](./LICENSE.md).

All materials contributed should be compatible with the GPLv2. This means that if you own the material, you agree to license it under the GPLv2 license. If you are contributing code that is not your own, such as adding a component from another Open Source project, or adding an `npm` package, you need to make sure you follow these steps:

1. Check that the code has a license. If you can't find one, you can try to contact the original author and get permission to use, or ask them to release under a compatible Open Source license.
2. Check the license is compatible with [GPLv2](http://www.gnu.org/licenses/license-list.en.html#GPLCompatibleLicenses), note that the Apache 2.0 license is _not_ compatible.
3. Add the code source URL (e.g. a GitHub URL), the files where it's used in the project and the full license terms to [`CREDITS.md`](./CREDITS.md)
4. Add attribution to the code, if applicable. This line should include the copyright notice of the source, and a reference to the license contained in [`CREDITS.md`](./CREDITS.md)
