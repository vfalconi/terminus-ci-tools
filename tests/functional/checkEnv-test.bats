#!/usr/bin/env bats

@test "run checkEnv command" {
  run terminus checkEnv
  [ "$status" -eq 1 ]
}
