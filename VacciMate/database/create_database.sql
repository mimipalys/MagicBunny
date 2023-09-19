CREATE TABLE Patient (
   PatientID VARCHAR(20) PRIMARY KEY,
   Fname VARCHAR(50) NOT NULL,
   Lname VARCHAR(50) NOT NULL,
   DateOfBirth DATE,
   Password VARCHAR(255) NOT NULL,
   MailAddress VARCHAR(100),
   PhoneNumber VARCHAR(15),
   Address VARCHAR(255)
);

CREATE TABLE Vaccine (
   VaccineID INT PRIMARY KEY AUTO_INCREMENT,
   VaccineName VARCHAR(100) NOT NULL,
   RelatedDisease VARCHAR(100),
   Description TEXT,
   DescriptionSource TEXT
);

CREATE TABLE VaccineSchedule (
   DoseNumber VARCHAR(100),
   VaccineID INT,
   MinimumGap INT, -- Minimum gap in days
   MaximumGap INT, -- Maximum gap in days
   PRIMARY KEY (DoseNumber, VaccineID),
   FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE VaccineClinic (
   VaccineClinicID INT PRIMARY KEY AUTO_INCREMENT,
   ClinicMailAddress VARCHAR(100),
   ClinicPhoneNumber VARCHAR(15),
   ClinicAddress VARCHAR(255)
);

CREATE TABLE HealthcareProvider (
   HealthcareProviderID INT,
   Fname VARCHAR(50) NOT NULL,
   Lname VARCHAR(50) NOT NULL,
   Password VARCHAR(255) NOT NULL,
   VaccineClinicID INT,
   PRIMARY KEY (HealthcareProviderID, VaccineClinicID),
   FOREIGN KEY (VaccineClinicID) REFERENCES VaccineClinic(VaccineClinicID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE VaccineDose (
   DoseID INT PRIMARY KEY,
   PatientID VARCHAR(20),
   HealthcareProviderID INT,
   VaccineID INT,
   DoseNumber VARCHAR(100),
   AdministrationDate DATE,
   FOREIGN KEY (PatientID) REFERENCES Patient(PatientID) ON DELETE CASCADE ON UPDATE CASCADE,
   FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON UPDATE CASCADE,
   FOREIGN KEY (DoseNumber, VaccineID) REFERENCES
VaccineSchedule(DoseNumber, VaccineID) ON UPDATE CASCADE,
FOREIGN KEY (HealthcareProviderID) REFERENCES HealthcareProvider(HealthcareProviderID) ON UPDATE CASCADE
);

CREATE TABLE Country (
   CountryID INT PRIMARY KEY AUTO_INCREMENT,
   Name VARCHAR(100) NOT NULL,
   Continent VARCHAR(50),
   Description TEXT
);

CREATE TABLE CountryVaccineRequirements (
   CountryVaccineRequirementsID INT PRIMARY KEY AUTO_INCREMENT,
   CountryID INT,
   VaccineID INT,
   FOREIGN KEY (CountryID) REFERENCES Country(CountryID) ON DELETE CASCADE ON UPDATE CASCADE,
   FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE SavedVaccine (
   PatientID VARCHAR(20),
   VaccineID INT,
PRIMARY KEY(PatientID, VaccineID),
   FOREIGN KEY (PatientID) REFERENCES Patient(PatientID) ON DELETE CASCADE ON UPDATE CASCADE,
   FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Feedback (
   FeedbackID INT PRIMARY KEY AUTO_INCREMENT,
   PatientID VARCHAR(20),
   VaccineID INT,
   Comment TEXT,
   FOREIGN KEY (PatientID) REFERENCES Patient(PatientID) ON DELETE CASCADE ON UPDATE CASCADE,
   FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON DELETE CASCADE ON UPDATE CASCADE
);





