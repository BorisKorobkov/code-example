# Plural and singular names shouldn't be mixed. All names should be in the same format.
# The singular is preferable.
# @see https://de.wikipedia.org/wiki/Clean_Code

ALTER TABLE `logs` RENAME TO `log`;
ALTER TABLE `mandanten` RENAME TO `mandant`;
