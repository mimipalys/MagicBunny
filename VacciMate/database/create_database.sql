CREATE TABLE Patient (
    PatientID INT PRIMARY KEY,
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
    DoseNumber INT,
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
    HealthcareProviderID INT PRIMARY KEY,
    Fname VARCHAR(50) NOT NULL,
    Lname VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    VaccineClinicID INT,
    FOREIGN KEY (VaccineClinicID) REFERENCES VaccineClinic(VaccineClinicID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE VaccineDose (
    DoseID INT PRIMARY KEY,
    PatientID INT,
    HealthcareProviderID INT,
    VaccineID INT,
    DoseNumber INT,
    AdministrationDate DATE,
    ExpirationDate DATE,
    FOREIGN KEY (PatientID) REFERENCES Patient(PatientID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON UPDATE CASCADE,
    FOREIGN KEY (DoseNumber, VaccineID) REFERENCES 
VaccineSchedule(DoseNumber, VaccineID) ON UPDATE CASCADE,
FOREIGN KEY (HealthcareProviderID) REFERENCES HealthcareProvider(HealthcareProviderID) ON UPDATE CASCADE
);

CREATE TABLE Country (
    CountryID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Continent VARCHAR(50)
);

CREATE TABLE CountryVaccineRequirements (
    CountryVaccineRequirementsID INT PRIMARY KEY AUTO_INCREMENT,
    CountryID INT,
    VaccineID INT,
    Description TEXT,
    FOREIGN KEY (CountryID) REFERENCES Country(CountryID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE SavedVaccine (
    SavedVaccineID INT PRIMARY KEY AUTO_INCREMENT,
    PatientID INT,
    VaccineID INT,
    FOREIGN KEY (PatientID) REFERENCES Patient(PatientID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Feedback (
    FeedbackID INT PRIMARY KEY AUTO_INCREMENT,
    PatientID INT,
    VaccineID INT,
    Comment TEXT,
    FOREIGN KEY (PatientID) REFERENCES Patient(PatientID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (VaccineID) REFERENCES Vaccine(VaccineID) ON DELETE CASCADE ON UPDATE CASCADE
);